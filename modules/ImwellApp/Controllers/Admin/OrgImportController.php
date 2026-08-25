<?php

namespace Modules\ImwellApp\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Modules\ImwellApp\Exports\MemberSampleExport;
use Modules\ImwellApp\Mail\OrgActivationMail;
use Modules\ImwellApp\Models\ImwellOrg;
use Modules\ImwellApp\Models\ImwellOrgActivation;

/**
 * Imports members INTO a specific organisation.
 *
 * Differences from the legacy Admin\UserController::importSubscriber:
 *  - the organisation comes from the URL, never from cells inside the sheet,
 *    so no static school name / address / bundle block is needed;
 *  - the sheet is HEADER driven, not positional, so column order is free;
 *  - no password is generated, stored or emailed - the member activates via a
 *    one-time link and chooses their own password.
 */
class OrgImportController extends Controller
{
    /** Columns accepted in the CSV. Only the first three are required. */
    const COLUMNS = [
        'first_name', 'last_name', 'email',
        'phone', 'dob', 'gender',
        'address', 'address2', 'city', 'state', 'zip_code',
    ];

    public function form($id)
    {
        $org = ImwellOrg::findOrFail($id);

        $result = session('imwell_import_result');

        return view('ImwellApp::admin.import', compact('org', 'result'));
    }

    public function members(Request $request, $id)
    {
        $org = ImwellOrg::findOrFail($id);

        $members = User::where('imwell_org_id', $org->id)
            ->orderByDesc('id')
            ->paginate(25);

        return view('ImwellApp::admin.members', compact('org', 'members'));
    }

    /**
     * Downloadable sample sheet - headers plus one example row.
     * ?format=xlsx returns Excel, anything else returns CSV.
     */
    public function sampleCsv(Request $request)
    {
        $rows = [
            self::COLUMNS,
            ['Jane', 'Doe', 'jane.doe@example.com', '5551234567', '1990-04-21', 'Female',
             '12 Main St', 'Apt 4', 'Austin', 'TX', '73301'],
        ];

        if ($request->get('format') === 'xlsx') {
            return Excel::download(new MemberSampleExport($rows), 'imwell-members-sample.xlsx');
        }

        $handle = fopen('php://temp', 'r+');

        foreach ($rows as $row) {
            fputcsv($handle, $row);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="imwell-members-sample.csv"',
        ]);
    }

    public function import(Request $request, $id)
    {
        $org = ImwellOrg::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'sheet' => 'required|file|mimes:csv,txt,xlsx,xls',
        ], [
            'sheet.required' => 'Please choose a CSV or Excel file to import.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $rows = Excel::toArray(new \stdClass(), $request->file('sheet'));
        $rows = $rows[0] ?? [];

        if (count($rows) < 2) {
            return back()->with('error', 'The file has no data rows below the header.');
        }

        $map = $this->headerMap(array_shift($rows));

        if (! isset($map['email'])) {
            return back()->with('error', 'The header row must contain an "email" column.');
        }

        $created = 0;
        $skipped = [];

        foreach ($rows as $index => $row) {
            $line = $index + 2; // +1 for the removed header, +1 for 1-based rows.
            $data = $this->readRow($row, $map);

            if ($data === null) {
                continue; // entirely blank line
            }

            $rowError = $this->validateRow($data);

            if ($rowError) {
                $skipped[] = ['line' => $line, 'email' => $data['email'], 'reason' => $rowError];
                continue;
            }

            DB::beginTransaction();

            try {
                $user = $this->createMember($org, $data);

                $activation = ImwellOrgActivation::issueFor($user->id, $org->id);

                DB::commit();

                $this->sendActivation($org, $user, $activation);

                $created++;
            } catch (\Exception $e) {
                DB::rollBack();
                $skipped[] = ['line' => $line, 'email' => $data['email'], 'reason' => $e->getMessage()];
            }
        }

        return redirect()
            ->route('imwell.admin.import.form', $org->id)
            ->with('imwell_import_result', ['created' => $created, 'skipped' => $skipped])
            ->with('success', $created . ' member(s) imported into ' . $org->name . '.');
    }

    public function resendActivation($id, $userId)
    {
        $org  = ImwellOrg::findOrFail($id);
        $user = User::where('imwell_org_id', $org->id)->findOrFail($userId);

        $activation = ImwellOrgActivation::issueFor($user->id, $org->id);

        $this->sendActivation($org, $user, $activation);

        return back()->with('success', 'Activation link resent to ' . $user->email . '.');
    }

    // ------------------------------------------------------------------

    /** Maps normalised header labels to their column index. */
    protected function headerMap(array $header)
    {
        $aliases = [
            'firstname'    => 'first_name',
            'first'        => 'first_name',
            'lastname'     => 'last_name',
            'last'         => 'last_name',
            'emailaddress' => 'email',
            'mail'         => 'email',
            'phonenumber'  => 'phone',
            'primaryphone' => 'phone',
            'mobile'       => 'phone',
            'dateofbirth'  => 'dob',
            'zip'          => 'zip_code',
            'zipcode'      => 'zip_code',
            'postalcode'   => 'zip_code',
            'addressline2' => 'address2',
        ];

        $map = [];

        foreach ($header as $i => $label) {
            $key = preg_replace('/[^a-z0-9]/', '', strtolower((string) $label));

            if ($key === '') {
                continue;
            }

            $key = $aliases[$key] ?? $key;

            // "first_name" normalises to "firstname"; re-check aliases.
            if (! in_array($key, self::COLUMNS, true)) {
                $key = $aliases[$key] ?? $key;
            }

            if (in_array($key, self::COLUMNS, true)) {
                $map[$key] = $i;
            }
        }

        return $map;
    }

    protected function readRow(array $row, array $map)
    {
        $data = [];

        foreach (self::COLUMNS as $column) {
            $value = isset($map[$column]) && isset($row[$map[$column]]) ? $row[$map[$column]] : null;
            $data[$column] = is_string($value) ? trim($value) : $value;
        }

        $hasAnything = false;

        foreach ($data as $value) {
            if ($value !== null && $value !== '') {
                $hasAnything = true;
                break;
            }
        }

        return $hasAnything ? $data : null;
    }

    protected function validateRow(array $data)
    {
        if (empty($data['first_name']) || empty($data['last_name'])) {
            return 'First and last name are required.';
        }

        if (empty($data['email']) || ! filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return 'A valid email address is required.';
        }

        if (User::where('email', $data['email'])->exists()) {
            return 'This email already exists in the system.';
        }

        return null;
    }

    protected function createMember(ImwellOrg $org, array $data)
    {
        $user = new User();

        $user->fname         = $data['first_name'];
        $user->lname         = $data['last_name'];
        $user->name          = trim($data['first_name'] . ' ' . $data['last_name']);
        $user->email         = $data['email'];
        $user->primaryPhone  = $data['phone'] ?: null;
        $user->gender        = $data['gender'] ?: null;
        $user->address       = $data['address'] ?: null;
        $user->address2      = $data['address2'] ?: null;
        $user->city          = $data['city'] ?: null;
        $user->zipCode       = $data['zip_code'] ?: null;
        $user->user_role     = 'user';

        if (! empty($data['dob'])) {
            $user->dob = $this->normaliseDob($data['dob']);
        }

        // Unusable placeholder. Replaced when the member activates; never
        // emailed and never stored in plaintext anywhere.
        $user->password = Hash::make(Str::random(40));

        $user->imwell_org_id = $org->id;
        $user->status        = 0; // becomes 1 on activation

        $user->save();

        return $user;
    }

    protected function normaliseDob($value)
    {
        if (is_numeric($value)) {
            try {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float) $value)
                    ->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }

        $timestamp = strtotime((string) $value);

        return $timestamp ? date('Y-m-d', $timestamp) : null;
    }

    protected function sendActivation(ImwellOrg $org, User $user, ImwellOrgActivation $activation)
    {
        $url = url('/org/' . $org->slug . '/activate/' . $activation->token);

        try {
            Mail::to($user->email)->send(new OrgActivationMail($org, $user->name, $url));
        } catch (\Exception $e) {
            // A mail failure must not roll back a successfully created member;
            // the admin can resend from the members list.
            \Log::error('ImWell activation mail failed for ' . $user->email . ': ' . $e->getMessage());
        }
    }
}

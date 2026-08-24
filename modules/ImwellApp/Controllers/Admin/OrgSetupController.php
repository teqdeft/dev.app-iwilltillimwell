<?php

namespace Modules\ImwellApp\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\ImwellApp\Models\ImwellOrg;
use Modules\ImwellApp\Models\ImwellOrgFeature;
use Modules\ImwellApp\Support\Features;

class OrgSetupController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search', ''));

        $orgs = ImwellOrg::withCount('members')
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($w) use ($search) {
                    $w->where('name', 'like', '%' . $search . '%')
                      ->orWhere('slug', 'like', '%' . $search . '%')
                      ->orWhere('contact_email', 'like', '%' . $search . '%');
                });
            })
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('ImwellApp::admin.index', compact('orgs', 'search'));
    }

    public function create()
    {
        $org      = new ImwellOrg(['status' => 1, 'primary_color' => '#994c8d']);
        $features = Features::toggleable();
        $enabled  = [];

        return view('ImwellApp::admin.form', compact('org', 'features', 'enabled'));
    }

    public function edit($id)
    {
        $org      = ImwellOrg::findOrFail($id);
        $features = Features::toggleable();
        $enabled  = $org->enabledFeatureKeys();

        return view('ImwellApp::admin.form', compact('org', 'features', 'enabled'));
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $data = $this->payload($request);
            $data['slug'] = ImwellOrg::makeSlug($request->input('name'));

            $org = ImwellOrg::create($data);

            $this->storeLogo($request, $org);
            $this->syncFeatures($org, (array) $request->input('features', []));

            DB::commit();

            return redirect()
                ->route('imwell.admin.edit', $org->id)
                ->with('success', 'Organization created. Member URL: ' . $org->url());
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $org = ImwellOrg::findOrFail($id);

        $validator = $this->validator($request, $org->id);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $data = $this->payload($request);

            // The slug follows the organisation name. It is only regenerated
            // when the name actually changes, so links already handed out to
            // members of untouched organisations keep working.
            if ($org->name !== $request->input('name')) {
                $data['slug'] = ImwellOrg::makeSlug($request->input('name'), $org->id);
            }

            $org->update($data);

            $this->storeLogo($request, $org);
            $this->syncFeatures($org, (array) $request->input('features', []));

            DB::commit();

            return redirect()
                ->route('imwell.admin.edit', $org->id)
                ->with('success', 'Organization updated. Member URL: ' . $org->fresh()->url());
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        $org = ImwellOrg::findOrFail($id);
        $org->status = ! $org->status;
        $org->save();

        return back()->with('success', 'Status updated for ' . $org->name . '.');
    }

    public function destroy($id)
    {
        $org = ImwellOrg::findOrFail($id);

        if ($org->members()->count() > 0) {
            return back()->with('error', 'Cannot delete: this organization still has imported members.');
        }

        $org->delete();

        return redirect()->route('imwell.admin.index')->with('success', 'Organization deleted.');
    }

    /** Live slug preview for the admin form (AJAX). */
    public function slugPreview(Request $request)
    {
        return response()->json([
            'slug' => ImwellOrg::makeSlug((string) $request->input('name'), $request->input('id')),
        ]);
    }

    // ------------------------------------------------------------------

    protected function validator(Request $request, $ignoreId = null)
    {
        return Validator::make($request->all(), [
            'name'          => 'required|string|max:191',
            'contact_email' => 'nullable|email|max:191',
            'contact_phone' => 'nullable|string|max:40',
            'primary_color' => 'nullable|string|max:20',
            'logo'          => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'description'   => 'nullable|string',
        ]);
    }

    protected function payload(Request $request)
    {
        return [
            'name'          => $request->input('name'),
            'description'   => $request->input('description'),
            'contact_name'  => $request->input('contact_name'),
            'contact_email' => $request->input('contact_email'),
            'contact_phone' => $request->input('contact_phone'),
            'address'       => $request->input('address'),
            'city'          => $request->input('city'),
            'state'         => $request->input('state'),
            'zip_code'      => $request->input('zip_code'),
            'primary_color' => $request->input('primary_color') ?: '#994c8d',
            'status'        => $request->boolean('status'),
        ];
    }

    protected function storeLogo(Request $request, ImwellOrg $org)
    {
        if (! $request->hasFile('logo')) {
            return;
        }

        $dir = public_path('uploads/imwell-orgs');

        if (! file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        $previous = $org->logo;

        $file = $request->file('logo');
        $name = 'org-' . $org->id . '-' . time() . '.' . $file->getClientOriginalExtension();

        $file->move($dir, $name);

        $org->logo = 'uploads/imwell-orgs/' . $name;
        $org->save();

        // Remove the previous file so uploads do not accumulate.
        if ($previous && $previous !== $org->logo && file_exists(public_path($previous))) {
            @unlink(public_path($previous));
        }
    }

    protected function syncFeatures(ImwellOrg $org, array $selected)
    {
        foreach (Features::toggleable() as $feature) {
            ImwellOrgFeature::updateOrCreate(
                ['imwell_org_id' => $org->id, 'feature_key' => $feature['key']],
                ['enabled' => in_array($feature['key'], $selected, true) ? 1 : 0]
            );
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GroupCounseling as GP;
use App\Models\GroupCounselingTime as GCT;
use View;
use App\Validators\GroupCounselingValidator;
use App\Models\BraintreeTransaction;
use App\Http\Controllers\CounselingController;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateHostLinkMail;

class GroupCounseling extends Controller
{
    public function createGroupCounseling(Request $request)
    {
        $users = User::where(array('user_role' => 'user'))->count();

        return view('admin.counseling.index', compact('users'));
    }

    public function getAllCounseling(Request $request)
    {
        $allCounseling = GP::with("timeTable")->get();
        return response()->json(['data' =>  $allCounseling]);
    }

    public function loadAddtModal()
    {
        $users = User::where(array('user_role' => 'counsellor'))->whereNull('deleted_at')->orderby("id","desc")->get();
        $type = "add";
        return view('admin.counseling.add-edit-form', compact('users', 'type'));
    }
    public function loadEditModal($id)
    {
        $users = User::where(array('user_role' => 'counsellor'))->whereNull('deleted_at')->orderby("id","desc")->get();
        $gcd = GP::with('timeTable')->where(array('id' => $id))->first();
        $type = "edit";
        return view('admin.counseling.add-edit-form', compact('users', 'gcd', 'type'));
    }

    public function createSesson(Request $request)
    {
        $counseling = new GroupCounselingValidator();
        try {
            $input = $request->all();

            if (!$counseling->with($input)->passes()) {
                $request->session()->flash('error', $counseling->getErrors()[0]);
                return back()
                    ->withErrors($counseling->getValidator())
                    ->withInput();
            }
            $type = $input['type'];
            if ($type == 'edit') {
                $id = $input['counseling_id'];
                $obj = GP::with('timeTable')->where(array('id' => $id))->first();
            } else {
                $obj = new GP();
            }

            $obj->title =  $input['title'];
            $obj->description =  $input['description'];
            $obj->user_id =  $input['counseler_id'];
            $obj->counseler_name =  $input['counseler_id'];
            $obj->minimum_number_of_users =  $input['minimum_number_of_users'];
            $obj->maximum_number_of_users =  $input['maximum_number_of_users'];
            $channel_name =  $input['title'] . "_" . date("Y-m-d") . "_" . time();
            $obj->link =  str_replace('-', '_', $channel_name);
            $obj->registration_fee =  $input['registration_fee'];
            $obj->last_registration_date =  $input['last_registration_date'];

            if ($counslingId = $obj->save() && $type == 'add') {
                if (!empty($input['day']) && !empty($input['start_time']) && !empty($input['end_time'])) {
                    $timing = [];
                    foreach ($input['day'] as $eachKey => $eachDay) {
                        $gdtObject = new GCT();
                        $gdtObject->group_counseling_id = $obj->id;
                        $gdtObject->date =  date("Y-m-d", strtotime(date($input['day'][$eachKey])));
                        $gdtObject->startTime = date("H:i:s", strtotime($input['start_time'][$eachKey]));
                        $gdtObject->endTime = date("H:i:s", strtotime($input['end_time'][$eachKey]));
                        $gdtObject->time_zone = $input['define_user_time_zone'];
                        $gdtObject->save();
                        $timing['counselingTime'][] = [
                            'start' => "{$gdtObject->date} {$gdtObject->startTime}",
                            'end' => "{$gdtObject->date} {$gdtObject->endTime}"
                        ];
                    }

                    /* send host link in mail */
                    $users = User::find($input['counseler_id']);
                    $generate = new CounselingController();
                    $transaction                   = new BraintreeTransaction();
                    $transaction->user_id = $input['counseler_id'];
                    $transaction->amount = 0;
                    $transaction->counseling_id = $obj->id;
                    $transaction->status = "payment_for_host";
                    $transaction->transaction_id = "{$input['counseler_id']}_test_host";
                    $transaction->final_amount = 0;
                    $transaction->token = $generate->generateRandomKey();
                    $transaction->transaction_type = 'counseling';

                    if ($transaction->save()) {
                        $link = url("/host-group-counseling/") . "/{$transaction->token}";
                        $data = [
                            'email' => $users->email,
                            'name' => "{$users->lname} {$users->lname}",
                            'link' => $link
                        ];
                        if (!empty($timing)) {
                            $data = $data + $timing;
                        }
                        $updateGp = new GP();
                        $updateObj = $updateGp->find($obj->id);
                        $updateObj->link = "/host-group-counseling/{$transaction->token}"; 
                        $updateObj->save();
                        Mail::to($users->email)->send(new CreateHostLinkMail($data));
                    }
                }
                $request->session()->flash('success', 'Session Added successfully.');
                return redirect('/admin/group-counseling');
            } else if ($type == 'edit') {
                $request->session()->flash('success', 'Session updated successfully.');
                return redirect('/admin/group-counseling');
            } else {
                return redirect()->back()->with('success', 'Error please try again Code is not generated');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    public function viewGroupCounselingDetails($id)
    {
        $gcd = GP::with('timeTable')->where(array('id' => $id))->first();
        // dd($gcd);
        return view('admin.counseling.show-details', compact('gcd'));
    }

    public function delete($id)
    {
        $gcd = GP::where(array('id' => $id))->delete();
        // if ($gcd->timeTable) {
        // }
        $users = User::where(array('user_role' => 'user'))->count();
        return view('admin.counseling.index', compact('users'));
    }
}

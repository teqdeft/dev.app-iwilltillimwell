<?php

namespace App\Http\Controllers\Counsellor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GroupCounseling as GP;
use App\Models\GroupCounselingUser;
use App\Models\GroupCounselingTime;

class SessionController extends Controller
{
    public function getAllSessions(Request $request)
    {
        $allCounseling = GP::all();
        if ($request->wantsJson() || $request->ajax()) {
            $jsonCollection = collect();
            $allCounseling->each(function ($item, $key) use ($jsonCollection) {
                $status  = "";
                $cons_date = GroupCounselingTime::latest('id')->first();
                $currentDate = date('Y-m-d');   
                if ($cons_date->date > $currentDate) {
                    $status = "Upcoming";
                } else if ($cons_date->date == $currentDate) {
                    $status = "Current";
                } else {
                    $count_users = GroupCounselingUser::where('group_counseling_id',$item->id)->count();
                    if ($count_users >= $item->minimum_number_of_users) {
                        $status = "Completed";
                    } else {
                        $status = "Cancelled";
                    }
                }
                $jsonCollection->push([
                        'sr_no' => $key+1,
                        'id' => $item->id,
                        'title' => $item->title,
                        'description' => $item->description,
                        'last_registration_date' => $item->last_registration_date,
                        'maximum_number_of_users' => $item->maximum_number_of_users,
                        'minimum_number_of_users' => $item->minimum_number_of_users,
                        'registration_fee' => "$".$item->registration_fee,
                        'status' => $status,
                ]);
            });
            return response()->json(['data' => $jsonCollection]);
        }
        return view('counsellor.sessions.index',compact('allCounseling'));
    }
    public function viewSessionDetails(Request $request,$id)
    {
        $gcd = GP::with('timeTable')->where(array('id' => $id))->first();
        $gcdusers = new GP();
        $rergisterUsers = $gcdusers->sessionRegister($id);
        if ($request->wantsJson() || $request->ajax()) {
            $jsonCollection = collect();
            $rergisterUsers->each(function ($item, $key) use ($jsonCollection) {
                $status  = "Paid";
                if( !empty($item->type) ){
                    $status = "Auto Refund";
                }
                $jsonCollection->push([
                        'sr_no' => $key+1,
                        'name' => $item->name,
                        'register' => date('Y-m-d h:i A',strtotime($item->created_at)),
                        'status' => $status,
                ]);
            });
            return response()->json(['data' => $jsonCollection]);
        }
        return view('counsellor.sessions.show-details', compact('gcd','rergisterUsers'));
    }
}

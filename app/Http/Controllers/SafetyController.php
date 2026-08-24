<?php

namespace App\Http\Controllers;

use App\Models\SafetyPlan;
use App\Models\SaftyPlanUser;
use App\Models\SendToFriendList;
use App\Traits\ShareToFriend;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SafetyController extends Controller
{
    use ShareToFriend;

    function index(Request $request) {

        $safetyPlans = SafetyPlan::all();

        $friendContact = SendToFriendList::orderBy('id','desc')->get();

        if(isMobile()){
            return view("mobile.services.safety-plan.index",compact('safetyPlans','friendContact'));
        }
        return view("services.safety.index",compact('safetyPlans','friendContact'));
    }

    function store(Request $request){



        try{

            $field = array_filter($request->input('fields'));

            if(empty($field)){

                $request->session()->flash('error','Please fill at least one field');

            }
           


            $data = [

                'user_id'     => Auth::user()->id,

                'safty_title' => $request->input('plan_type'),

                'plan_data'   => implode(',',$field) 

            ];

            $existingCount = SaftyPlanUser::where('user_id', Auth::id())->where('safty_title', $request->input('plan_type'))->count();
            if ($existingCount > 1) {
                SaftyPlanUser::where('user_id', Auth::id())->where('safty_title', $request->input('plan_type'))->delete();
            }

            SaftyPlanUser::updateOrCreate(
                [
                    'user_id'     =>Auth::user()->id,
                    'safty_title' => $request->input('plan_type'),
                ],
                [
                    'plan_data' => implode(',', $field),
                ]
            );


            

            $name = Auth::user()->name;

            $sendFeel = [

                    'phone' =>  "{$name}'s Today Safety Plan \n Title : {$data['safty_title']} \n Plan : {$data['plan_data']} \n",

                    'email'  => [ 'body' => "<p>Title : {$data['safty_title']}</p><p>Plan : {$data['plan_data']}</p>",

                                    'title' => "<h4>{$name}'s Today Safety Plan</h4>" ]

            ];

            //$this->checkSendType(Auth::user()->id,'my_mood',$sendFeel);
				
			if(isMobile()){
				
				return response()->json([
						'success' => true,
						'message' => 'Safety Plan add successfully'
					]);
			}	
			
            return redirect()->back()->with('success','Safety Plan add successfully');

        }catch(Exception  $e){

            dd($e->getMessage());

        }

    }
}

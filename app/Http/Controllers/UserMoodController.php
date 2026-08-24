<?php

namespace App\Http\Controllers;

use LaravelEmojiOne;
use Emojione\Ruleset;
use App\Models\UserMood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Validators\UserMoodValidator;
use App\Models\UserMeta;
use App\Traits\ShareToFriend;
use Carbon\Carbon;use Illuminate\Support\Facades\DB;
class UserMoodController extends Controller
{
    use ShareToFriend;
    function index(Request $request){
        $emotionally = $data = [];
        $physically = Config('constants.EMOJI');
        if(isMobile()){
            return view("mobile.services.moods.index",compact('physically'));
        }
        return view('services.moods.index',compact('physically'));

    }
    public function MyMoodFeelingHistory(Request $request) {
        if(isMobile()){
            return view("mobile.services.my-mood-feeling-history");
        } else {
            $userMoods = UserMood::where('user_id',Auth::user()->id) ->orderBy('id','desc')->get();
            return view('services.moods.moodLogs',compact('userMoods'));
        }
    }

    public function myMoodFeelingSave(Request $request){
        
		
        try{
            $input = $request->all();
            $userMoodValid = new UserMoodValidator;
            if (!$userMoodValid->with($input)->passes()) {
                return \json_encode(['message' => $userMoodValid->getErrors()[0],'status' => 0 ]);
            }
            $physically = str_replace(':','',$input['physicallyParent'])."-".str_replace(':','',$input['physicallyChild']).'-'
                        .str_replace(':','',$input['physicallySubChild']);

            $insertData = [
                ['type' => 'physically','text' => $physically,'mood' => $input['physicallyParent'] ],
            ];


            foreach($insertData as $key => $value){
                $data = [
                    'user_id'    => Auth::user()->id,
                    'mood'       => $value['mood'],
                    'emoji_date' => date('Y-m-d'),
                    'type'       => $value['type'],
                    'text'       =>  $value['text'],
                    'parent_id'  => Auth::user()->parentId,
                    'mood_number' => $input['mood_number'],

                ];
                $userMood =  UserMood::create($data);
            }

            $name = Auth::user()->name;
            $sendFeel = [
                    'phone' =>  "{$name}'s Today Mood \n Mood : {$physically} \n\n",
                    'email'  => [ 'body' => "<p>Mood : {$physically}</p>",
                                    'title' => "<h4>{$name}'s Today Mood</h4>" ]
            ];
			
            $this->checkSendType(Auth::user()->id,'my_mood',$sendFeel);		
			/**/
			$lastInsertedId = $userMood->id;			
            return \json_encode(['message' => "Your mood successfuly added",'status' => 1,'mood_id' => $lastInsertedId ]);
 
        }catch(\Exception $e){
            return \json_encode(['message' => $e->getMessage(),'status' => 0 ]);
        }
		
    }

    public function storeSaveModeMessage(Request $request) {
        echo "Hi";
    }

    public function moodLogs(Request $request){

        $userMoods = UserMood::where('user_id',Auth::user()->id)
                    ->orderBy('id','desc')->get();
        if ($request->wantsJson() || $request->ajax()) {
          $jsonCollection = collect();
          $userMoods->each(function ($item, $key) use ($jsonCollection) {
                $img = asset(emojiCustomImg($item->mood));
                $url = url('my-mood-feeling-history-deleted');
				$formattedDate = Carbon::parse($item->created_at)->format('l, F d, Y h:i A');
                
				$modal_title = str_replace("-"," ",$item->text);
				if(isMobile()) {
                    $img = asset(emojiCustomImgMobile($item->mood));
                    $delete_ico =asset('assets/dashboard/assets/images/delete-vector.svg');
                    $watch_ico = asset('assets/dashboard/assets/images/watch-gray-icon.svg');
                    $jsonCollection->push([

                        'id'    => $item->id,
                        'image' => "<img src='{$img}'>",
                        'title' =>"$item->text",
                        'watch_ico' =>"<img src='$watch_ico' >",
                        'date'  => $formattedDate,
                        'modal_title'  => $modal_title,
                        'deleted_ico' => "<a deleted_id='$item->id' href='javascript:void(0)' class='delete-m open-modal' data-modal='FeelingHistory'><img src='$delete_ico'  /></a>"
                        ]);

                } else { 

                    $jsonCollection->push([
                        'id'    => $item->id,
                        'title' => "<div class='mood-view' mood-id='".$item->id."' modal_title='".$modal_title."'><a href='javascript:void(0)'><img src='{$img}'><span style='text-transform: capitalize;margin-left:35px;'>{$item->text}</span></a></div>",
                        'date'  => '<a href="javascript:void(0)" class="mood-view" mood-id='.$item->id.' modal_title='.$modal_title.'>'.$formattedDate.'</a>',
                        'delete' => "<a href='javascript:void(0)' number='{$item->id}' class='mood-view-icon deleteByAjax' data-url='{$url}'><i class='fa fa-trash' aria-hidden='true'></i></a>"
                    ]);

                }
                

            });
            return response()->json(['data' => $jsonCollection]);
        }
        return view('services.moods.moodLogs',compact('userMoods'));


        /* $userMoods = UserMood::where('user_id',Auth::user()->id)
                    ->orderBy('id','desc')->get()->toArray(); 
        $emotionally = $physically = [];
        if( $userMoods ){
            foreach($userMoods as $key => $value){
                if( $value['type'] == 'physically' ){
                    $physically[] = $value + ['img' => asset(emojiCustomImg($value['mood'])) ];
                }elseif( $value['type'] == 'emotionally' ){
                    $emotionally[] = $value + ['img' => asset(emojiCustomImg($value['mood'])) ];
                }
            }
        }
        return view('services.moods.moodLogs',compact('physically','emotionally')); */
    }

    public function moodDelete(Request $request){
        $input = $request->all();
        UserMood::destroy($input['id']);
    }


    	public function dashboard(Request $request){ 

		$startDate = date('Y-m-1');
        $endDate = date('Y-m-t');
        $getGraph = $_GET['graph']??false;

        if( $getGraph  ){
            if( $_GET['graph'] == 'Week' ){
                $startDate = date('Y-m-d',strtotime('-6 Days'));
                $endDate = date('Y-m-d');
            }elseif( $_GET['graph'] == 'Year' ){
                $startDate = date('Y-1-1');
                $endDate = date('Y-12-31');
            }    
        }
        
        $userMood = UserMood::where('user_id',Auth::user()->id)->whereBetween('emoji_date',[$startDate,$endDate])->get()->toArray();

        $currentMonthChart = [];

        foreach($userMood as $key => $value){
            /* Curernt Month Data */
            $date = removeZero(date('d',strtotime($value['emoji_date'])));

            if( $getGraph && $getGraph == 'Year' ){
                $date = removeZero(date('m',strtotime($value['emoji_date'])));
            }

            $currentMonthChart[$value['type']][$date][$value['mood']]['mood_name'] =  substr($value['text'], 0, strpos($value['text'], "-"));
            $currentMonthChart[$value['type']][$date][$value['mood']]['mood_count'][] = substr($value['text'], 0, strpos($value['text'], "-"));;

        }
        $physically  = chartJsData($currentMonthChart,'physically',$_GET['graph']??'');
		return view("services.graphDashboard", compact(["physically"]));
	}

    public function logout(Request $request) {
        //activityLog('Logout our account');
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/feels/login');
    }

    function behavioralHealth(){

        if(isMobile()){
            return view("mobile.services.behavioral-health");
        }
        return view('services/behavioral-health');
    }

    function journal(Request $request){
        return view('services.journal');
    }

    function medicalFormByUser(Request $request){
        $fieldData = $request->all();
        if( $fieldData ){
            unset($fieldData['_token']);
            foreach($fieldData as $key => $value){
                if( !empty($fieldData[$key]) ){
                    UserMeta::create(['user_id' => Auth::user()->id,'prefix'=> 'iwilltilimwell','meta_key' => $key,'meta_value' => $value]);
                }
            }
            UserMeta::create(['user_id' => Auth::user()->id,'prefix'=> 'iwilltilimwell','meta_key' => 'medical_process','meta_value' => 1]);
        }
        return redirect()->back()->with('success','Medical data successfully updates');
    }

    public function saveMood(Request $request){
        try{
            $input = $request->all();
            $userMoodValid = new UserMoodValidator;
            if (!$userMoodValid->with($input)->passes()) {
                return \json_encode(['message' => $userMoodValid->getErrors()[0],'status' => 0 ]);
            }
            $physically = str_replace(':','',$input['physicallyParent'])."-".str_replace(':','',$input['physicallyChild']).'-'
                        .str_replace(':','',$input['physicallySubChild']);

            $insertData = [
                ['type' => 'physically','text' => $physically,'mood' => $input['physicallyParent'] ],
            ];


            foreach($insertData as $key => $value){
                $data = [
                    'user_id'    => Auth::user()->id,
                    'mood'       => $value['mood'],
                    'emoji_date' => date('Y-m-d'),
                    'type'       => $value['type'],
                    'text'       =>  $value['text'],
                    'parent_id'  => Auth::user()->parentId,
                    'mood_number' => $input['mood_number'],

                ];
                UserMood::create($data);
            }

            $name = Auth::user()->name;
            $sendFeel = [
                    'phone' =>  "{$name}'s Today Mood \n Mood : {$physically} \n\n",
                    'email'  => [ 'body' => "<p>Mood : {$physically}</p>",
                                    'title' => "<h4>{$name}'s Today Mood</h4>" ]
            ];
			
            //$this->checkSendType(Auth::user()->id,'my_mood',$sendFeel);
			
            return \json_encode(['message' => "Your mood successfuly added",'status' => 1 ]);

        }catch(\Exception $e){
            return \json_encode(['message' => $e->getMessage(),'status' => 0 ]);
        }
    }
    public function ViewFeeling(Request $request) {		$input = $request->all();		/* $user = Auth::user();                $data = Cbt::where(['user_id' => $user->id,'id' => $input['id'] ])->first(); */				$data = DB::table('journals')->where('mood_id', $input['id'])->first();        $html = view("mobile.services.moods.view-feeling-ajax",compact('data'))->render();		return response()->json(['data' => $html]);					}
}

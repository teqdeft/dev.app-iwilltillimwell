<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

use App\Models\Cbt;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;

use Carbon\Carbon;




class CBTController extends Controller

{





    function index(Request $request){



        $data['id'] = "";

        $data['automatic_thought'] = "";

        $data['challenge_thought'] = "";

        $data['alternative_thought'] = "";
        
        $data['cbt_feel'] = "";

        $data['distortion_information'] ="";
        

        $data['thought_details'] = array();  

        if(isMobile()){

            return view("mobile.services.cbt.index",compact('data'));

        }

        return view('services.cbt.index',compact('data'));

    }



    function store(Request $request){

        $user = Auth::user();

        $input = $request->all();

        unset($input['_token']);

        if( !empty($input['thought_details']) ){

            $input['thought_details'] = json_encode($input['thought_details']);

        }

        $cbt = ( new Cbt());

        $msg = 'save';

        if( isset($input['id']) ){

            $id = $input['id'];

            unset($input['id']);

            $cbt->where(['user_id' => $user->id,'id' => $id  ])->update($input);

            $msg = 'update';

        }else{

            $input['user_id'] = $user->id;

            $cbt->insert($input);

        }



        $request->session()->flash('success', "Cognitive behavioural successfully {$msg}");

        if(isMobile()) {

            return true;

        }

        //return redirect('cbt-therapy-list');

    }



    function list(Request $request){
        
    $user = Auth::user();
    

        

        $dataArray = [];

        $data = Cbt::where('user_id',$user->id)->orderBy('id','desc')->get();

        if( $data ){

            foreach($data as $key => $value){

                $label = date("D M d Y",strtotime($value->created_at));

                if( date('Y-m-d',strtotime($value->created_at)) == date('Y-m-d') ){

                    $label = "Today";

                }

                $dataArray[date('Y-m-d',strtotime($value->created_at))]['header'] = $label;

                $dataArray[date('Y-m-d',strtotime($value->created_at))]['list'][] = $value;

            }

        }


        $cbt_avg_section = $this->getCBTScoreAvg($request);


    
        $records = DB::table('cbts')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw("COUNT(*) as total"),
                DB::raw("SUM(CASE WHEN cbt_feel = 'Better' THEN 1 ELSE 0 END) as better"),
                DB::raw("SUM(CASE WHEN cbt_feel = 'Same' THEN 1 ELSE 0 END) as same"),
                DB::raw("SUM(CASE WHEN cbt_feel = 'Worse' THEN 1 ELSE 0 END) as worse")
            )
            ->where('user_id', $user->id)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $better = [];
        $same = [];
        $worse = [];

        foreach ($records as $row) {

            $labels[] = Carbon::parse($row->date)->format('M d');
            $better[] = round(($row->better / $row->total) * 100);
            $same[]   = round(($row->same / $row->total) * 100);
            $worse[]  = round(($row->worse / $row->total) * 100);

        }    
        
        
    
         $data = Cbt::where('user_id', $user->id)
                ->when($request->cbt_feel, function ($query) use ($request) {
                    $query->where('cbt_feel', $request->cbt_feel);
                })
                ->when($request->cbt_date_filter, function ($query) use ($request) {
                    $query->whereDate('created_at', $request->cbt_date_filter);
                })
                ->orderBy('id', 'desc')
                ->get();


                $total_cbt_count = $this->getCbtCount($request,$user->id);
                $better          = $this->getCbtCount($request,$user->id, 'better');
                $same            = $this->getCbtCount($request,$user->id, 'same');
                $worse           = $this->getCbtCount($request,$user->id, 'worse');

                $cbt_graph_data = [
                                        [
                                            'label' => 'Better',
                                            'value' => $better,
                                            'percent' => $total_cbt_count ? round(($better / $total_cbt_count) * 100) : 0,
                                            'class' => 'better'
                                        ],
                                        [
                                            'label' => 'Same',
                                            'value' => $same,
                                            'percent' => $total_cbt_count ? round(($same / $total_cbt_count) * 100) : 0,
                                            'class' => 'same'
                                        ],
                                        [
                                            'label' => 'Worse',
                                            'value' => $worse,
                                            'percent' => $total_cbt_count ? round(($worse / $total_cbt_count) * 100) : 0,
                                            'class' => 'worse'
                                        ]
                                 ];        
                                 
    
        if(isMobile()){

            return view("mobile.services.cbt.list",compact('dataArray','cbt_graph_data','data','cbt_avg_section','labels','better','same','worse','total_cbt_count'));

        }

        return view('services.cbt.list',compact('data','cbt_graph_data','cbt_avg_section','labels','better','same','worse','total_cbt_count'));

    }

    public function getCbtCount($request,$userId, $feel = null)
            {
            
                return Cbt::where('user_id', $userId)
                    ->when($feel, function ($query) use ($feel) {
                        $query->where('cbt_feel', $feel);
                    })
                    ->when($request->cbt_feel, function ($query) use ($request) {
                      $query->where('cbt_feel', $request->cbt_feel);
                    })

                    ->when(!empty($request->cbt_date_filter), function ($query) use ($request) {
                                $dates = explode(' to ', $request->cbt_date_filter);
                                if (count($dates) === 2) {
                                    $start = \Carbon\Carbon::parse(trim($dates[0]))->startOfDay();
                                    $end   = \Carbon\Carbon::parse(trim($dates[1]))->endOfDay();

                                    $query->whereBetween('created_at', [$start, $end]);
                                }
                        })
                        
                    ->count();
            }

    public function getCBTScoreAvg($request){

         $user = Auth::user();    
          return  DB::table('cbts')
                        ->where('user_id', $user->id)

                        ->when(!empty($request->cbt_feel), function ($query) use ($request) {
                                    $query->where('cbt_feel', $request->cbt_feel);
                        })

                        ->when(!empty($request->cbt_date_filter), function ($query) use ($request) {
                                $dates = explode(' to ', $request->cbt_date_filter);
                                if (count($dates) === 2) {
                                    $start = \Carbon\Carbon::parse(trim($dates[0]))->startOfDay();
                                    $end   = \Carbon\Carbon::parse(trim($dates[1]))->endOfDay();

                                    $query->whereBetween('created_at', [$start, $end]);
                                }
                        })


                        ->selectRaw("
                            COUNT(*) as total_records,

                            SUM(cbt_feel = 'worse') as worse_count,
                            SUM(cbt_feel = 'same') as same_count,
                            SUM(cbt_feel = 'better') as better_count,

                            ROUND(SUM(cbt_feel = 'worse') * 100 / COUNT(*), 0) as worse_percentage,
                            ROUND(SUM(cbt_feel = 'same') * 100 / COUNT(*), 0) as same_percentage,
                            ROUND(SUM(cbt_feel = 'better') * 100 / COUNT(*), 0) as better_percentage
                        ")
                        ->first();  
    }    


    function edit(Request $request){



        $id = $request->id;

        $user = Auth::user();

        $datas = Cbt::where(['user_id' => $user->id,'id' => $id])->first();

        $data['id'] = $datas['id'];

        $data['thought_details'] = $datas['thought_details'];

        $data['automatic_thought'] = $datas['automatic_thought'];

        $data['challenge_thought'] = $datas['challenge_thought'];

        $data['alternative_thought'] = $datas['alternative_thought'];

        $data['cbt_feel'] = $datas['cbt_feel']; 

        $data['distortion_information'] = $datas['distortion_information'];
        

        if(isMobile()){

            return view("mobile.services.cbt.index",compact('data'));

        }

        return view("services.cbt.index",compact('data'));

    }



    function delete(Request $request){

        $user = Auth::user();

        $input = $request->all();

        Cbt::where(['user_id' => $user->id,'id' => $input['id'] ])->delete();

    }



    function cbtView(Request $request){

        $user = Auth::user();

        $input = $request->all();

        $data = Cbt::where(['user_id' => $user->id,'id' => $input['id'] ])->first();

        $html = "Hi";

        $html = view("mobile.services.cbt.view",compact('data'))->render();

		return response()->json(['data' => $html]);

    }


    public function cbtGetRefection(Request $request) {

        $cbt_details = Cbt::where('id',$request->id)->orderBy('id','desc')->first();
        return view("services.cbt.cbt-get-refection",compact('cbt_details'));

    }
    public function cbtContentLoad(Request $request) {

            $user = Auth::user();
            
            $cbt_avg_section = $this->getCBTScoreAvg($request);
            $total_cbt_count = $this->getCbtCount($request,$user->id);
            $better          = $this->getCbtCount($request,$user->id, 'better');
            $same            = $this->getCbtCount($request,$user->id, 'same');
            $worse           = $this->getCbtCount($request,$user->id, 'worse');


            
            $data = Cbt::where('user_id', $user->id)
               
                
                ->when($request->cbt_feel, function ($query) use ($request) {
                    $query->where('cbt_feel', $request->cbt_feel);
                })

                 ->when(!empty($request->cbt_date_filter), function ($query) use ($request) {
                    $dates = explode(' to ', $request->cbt_date_filter);
                    if (count($dates) === 2) {
                        $start = \Carbon\Carbon::parse(trim($dates[0]))->startOfDay();
                        $end   = \Carbon\Carbon::parse(trim($dates[1]))->endOfDay();

                        $query->whereBetween('created_at', [$start, $end]);
                    }
                })
               

                ->orderBy('id', 'desc')
                ->get();

            $cbt_graph_data = [
                                        [
                                            'label' => 'Better',
                                            'value' => $better,
                                            'percent' => $total_cbt_count ? round(($better / $total_cbt_count) * 100) : 0,
                                            'class' => 'better'
                                        ],
                                        [
                                            'label' => 'Same',
                                            'value' => $same,
                                            'percent' => $total_cbt_count ? round(($same / $total_cbt_count) * 100) : 0,
                                            'class' => 'same'
                                        ],
                                        [
                                            'label' => 'Worse',
                                            'value' => $worse,
                                            'percent' => $total_cbt_count ? round(($worse / $total_cbt_count) * 100) : 0,
                                            'class' => 'worse'
                                        ]
                                ];   

        $html = view("services.cbt.cbt-content-load",compact('data','cbt_graph_data','total_cbt_count','cbt_avg_section'))->render();

        return response()->json([
                'html' => $html,
                'chart_data' => $cbt_graph_data,
                'total' => $total_cbt_count
            ]);




    }

}


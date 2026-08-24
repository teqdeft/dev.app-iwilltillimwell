<?php
namespace App\Http\Controllers\Affiliate;
use App\Models\UserMood;
use App\Models\Promocode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CommissionTransaction;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $id = auth()->user()->id;
        $codes = Promocode::where(array('influencer_id' => $id))->count();
        $amount = CommissionTransaction::where(array('influencer_id' => $id))->sum('influencer_payable_amount');

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
        
        $userMood = UserMood::where('parent_id',$id)->whereBetween('emoji_date',[$startDate,$endDate])->get()->toArray();
        $currentMonthChart = [];

        foreach($userMood as $key => $value){
            /* Curernt Month Data */
            $date = removeZero(date('d',strtotime($value['emoji_date'])));

            if( $getGraph && $getGraph == 'Year' ){
                $date = removeZero(date('m',strtotime($value['emoji_date'])));
            }

            $currentMonthChart[$value['type']][$date][$value['mood']]['mood_name'] = $value['text'];
            $currentMonthChart[$value['type']][$date][$value['mood']]['mood_count'][] = $value['text'];

        }


        $physically  = chartJsData($currentMonthChart,'physically',$_GET['graph']??'');
        $emotionally = chartJsData($currentMonthChart,'emotionally',$_GET['graph']??'');        
        /* $chartData = [];
        foreach($userMood as $key => $value){
            $chartData[$value['type']][$value['text']][$key]['mood'] = LaravelEmojiOne::toImage($value['mood']);
            
        }

         */

        return view('affiliate.dashboard',compact('codes','amount','physically','emotionally'));
    }
}

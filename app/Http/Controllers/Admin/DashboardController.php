<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;
use LaravelEmojiOne;
use App\Models\UserMood;
use Illuminate\Http\Request;
use App\Models\Consultations;
use App\Models\GroupCounseling;
use App\Http\Controllers\Controller;

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
        $users = User::where(['parentId' => null,'payment_status' => 1,'user_role' => 'user', 'status' => 1])->count();

        $weekly_users = User::where(['parentId' => null,'payment_status' => 1,'user_role' => 'user', 'status' => 1])->whereBetween('created_at', [Carbon::now()->subDays(7)->startOfDay(), Carbon::now()->endOfDay()])->count();
        $weekly_consultations = Consultations::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        //$consultation = Consultations::all()->count();
        $consultation = GroupCounseling::all()->count();

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

        $userMood = UserMood::whereBetween('emoji_date',[$startDate,$endDate])->get()->toArray();
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
        return view('admin.dashboard', compact('users', 'consultation', 'weekly_consultations', 'weekly_users','physically','emotionally'));
    }
}

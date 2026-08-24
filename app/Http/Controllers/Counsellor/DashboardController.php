<?php
namespace App\Http\Controllers\Counsellor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GroupCounseling as GP;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $total_sessions = GP::where(array('user_id' => $user->id))->count();
        return view('counsellor.dashboard',compact('total_sessions'));
    }
}

<?php

namespace App\Http\Controllers\GroupOrganizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HistoryController extends Controller
{
    
	public function index() {
		
		$title = "Dashboard";
		if(ismobile()) {
			return view("mobile.group-organizations.history.list",compact('title'));
		}
		return view("group-organizations.history.list",compact('title'));
		
	}
	public function OrderHistory() {
		
		$title = "Dashboard";
		$id = auth()->user()->id;
		
		$OrderHistory = DB::table('braintree_subscription as a')
					->leftJoin('promocodes as b', 'a.promo_code_id', '=', 'b.id')
					->where('b.influencer_id', $id)
					->selectRaw("
						DATE_FORMAT(a.created_at, '%Y-%m') AS months,
						DATE_FORMAT(MIN(a.created_at), '%M, %Y') AS display_months,
						SUM(a.commission_amount) AS total_commission
					")
				->groupByRaw("DATE_FORMAT(a.created_at, '%Y-%m')")
				->orderByRaw("months DESC")
				->paginate(10);
		
		
		
		if(ismobile()) {
			return view("mobile.group-organizations.history.order-history",compact('OrderHistory'));
		}
		return view("group-organizations.history.order-history",compact('OrderHistory'));
		
	}
}

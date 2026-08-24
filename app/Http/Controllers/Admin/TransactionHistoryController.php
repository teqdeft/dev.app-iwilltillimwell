<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionHistoryController extends Controller
{
    
	public function index() {
		
		
		$transaction_history = DB::table('braintree_subscription as bs')
								->leftJoin('users as u', 'u.id', '=', 'bs.user_id')
								->leftJoin('plans as p', 'p.id', '=', 'bs.plan_id')
								->leftJoin('promocodes as pc', 'pc.id', '=', 'bs.promo_code_id')
								->orderByDesc('bs.id')
								->select(
									'u.fname',
									'u.lname',
									'u.email', 

									'p.name as package_name',
									'bs.amount as package_amount',
									'bs.optional_amount',

									'pc.code as promo_code',      

									'bs.subscription_start_date',
									'bs.subscription_end_date',
									'bs.promo_code_value',
									'bs.final_amount',
									'bs.subscription_status',
									'bs.subscription_type',
									'bs.activation_type',
									'bs.plan_id as planid'
								)
								->paginate(15);
	
		
	
	
		return view('admin.history.transaction-history',compact('transaction_history'));
	}
	
}

<?php

namespace App\Http\Controllers\GroupOrganizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MemberController extends Controller
{
    
	public function index() {
		
		$title = "Dashboard";
		$id = auth()->user()->id;
		/* $users = DB::table('braintree_subscription as a')
			->leftJoin('promocodes as b', 'a.promo_code_id', '=', 'b.id')
			->leftJoin('users as u', 'u.id', '=', 'a.user_id')
			->where('a.activation_type', 'activation')
			->where(function ($q) {
				$q->whereNotNull('a.promo_code_id')
				  ->where('a.promo_code_id', '!=', '');
			})
			->where('b.influencer_id', $id)
			->select(
				'a.id',
				'u.fname',
				'u.lname',
				'u.payment_status',
				'u.created_at as user_created_at',
				'a.created_at as activation_date'
			)
			->orderBy('a.created_at', 'desc') 
			->paginate(10); */
			
			
		$users = DB::table('braintree_subscription as a')
					->leftJoin('promocodes as b', 'a.promo_code_id', '=', 'b.id')
					->where('b.influencer_id', $id)
					->where('a.activation_type','activation')
					->selectRaw("
						DATE_FORMAT(a.created_at, '%Y-%m') AS months,
						DATE_FORMAT(MIN(a.created_at), '%M, %Y') AS display_months,
						count(a.id) AS total_users
					")
				->groupByRaw("DATE_FORMAT(a.created_at, '%Y-%m')")
				->orderByRaw("months DESC")
				->paginate(10);
		
					
	
		if(ismobile()) {
			return view("mobile.group-organizations.member.member-list",compact('users'));
		}
		
		return view("group-organizations.member.member-list",compact('users'));
		
	}
}

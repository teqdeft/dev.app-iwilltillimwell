<?php

namespace App\Http\Controllers\GroupOrganizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promocode;

class CouponController extends Controller
{
    
	public function index() {
		
		$id = auth()->user()->id;
		$coupons_list = Promocode::where('influencer_id', $id)->orderBy('id', 'desc')->paginate(10);
		if(ismobile()) {
			return view("mobile.group-organizations.coupon.list",compact('coupons_list'));
		}
		
		return view("group-organizations.coupon.list",compact('coupons_list'));
		
	}
}

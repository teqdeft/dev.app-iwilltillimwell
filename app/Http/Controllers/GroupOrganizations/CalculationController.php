<?php

namespace App\Http\Controllers\GroupOrganizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculationController extends Controller
{
    
	public function index() {
		
		$title = "Dashboard";
		
		if(ismobile()) {
			return view("mobile.group-organizations.calculation.list",compact('title'));
		}
		
		return view("group-organizations.calculation.list",compact('title'));
		
	}
}

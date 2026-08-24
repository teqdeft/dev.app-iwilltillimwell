<?php

namespace App\Http\Controllers\GroupOrganizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promocode;
use App\Models\States;
use App\Models\Timezones;
use DB;
use App\Models\OrganizationsReward;

class DashboardController extends Controller
{
    
	public function index() {
		
		
		$id = auth()->user()->id;
        $data = getInfluenceWallet($id);
		
		$dashboard_info['total_user'] = $data['total_users'] ?? '0';
		$dashboard_info['total_promo_code'] = $data['total_codes'] ?? '0';
		$dashboard_info['total_commission'] = $data['total_commission'] ?? '0';
		$dashboard_info['total_withdrawal'] = $data['total_withdrawal'] ?? '0';
		$dashboard_info['balance'] = $data['total_balance'] ?? '0';
		
		if(ismobile()) {
			return view("mobile.group-organizations.dashboard",compact('dashboard_info'));
		}
		return view("group-organizations.dashboard",compact('dashboard_info')); 
		
	}
	
	public function myAccount(Request $request) {
		
	
		$user = $request->user();
		$states = States::all();
        $timezones= Timezones::all();
		
		if(ismobile()) {
			return view("mobile.group-organizations.my-account",compact('user','states','timezones'));
		}
		return view("group-organizations.my-account",compact('user','states','timezones'));
		
	}
	public function myCurrentPlan(Request $request) {
		
	
		$user = $request->user();
		$states = States::all();
		
		$organizationId = auth()->user()->organization_id;
		$myRewards = OrganizationsReward::where('organization_id', $organizationId)->orderBy('id', 'asc')->get();
		$defaultRewards = OrganizationsReward::where('organization_id', 0)->orderBy('id', 'asc')->get();
		$defaultreward_list = $myRewards->isNotEmpty() ? $myRewards : $defaultRewards;
		
		if(ismobile()) {
			return view("mobile.group-organizations.my-current-plan",compact('user','states','defaultreward_list'));
		}
		return view("group-organizations.my-current-plan",compact('user','states','defaultreward_list'));
		
	}
	
	public function updateProfile(Request $request) {
		
		
		try {
			
				$user = $request->user();
				$data = $request->all();
				 
				$user->fname          = $data['fname'];
				$user->lname          = $data['lname'];
				$user->address        = $data['address'];
				$user->address2       = $data['address2'];
				$user->stateid        = $data['stateid'];
				$user->dob            = date("m/d/Y", strtotime($data['dob']));
				$user->city           = $data['city'];
				$user->gender         = $data['gender'];
				$user->zipCode        = $data['zipCode'];
				$user->timezoneId     = $data['timezoneId'];
				$user->primaryPhone   = $data['primaryPhone'];
				$user->secondaryPhone = $data['secondaryPhone'];
				
				 if ($request->hasFile('profile_image')) {
					 
					$image = $request->file('profile_image'); 
					$allowedExtensions = ['jpg', 'jpeg', 'png'];
					$extension = strtolower($image->getClientOriginalExtension());
					if(!in_array($extension, $allowedExtensions)) {
						return redirect()->back()->with('error', 'Only JPG, JPEG, PNG files are allowed.');
					}
		
					if ($user->profile_image && file_exists(public_path('uploads/profile/' . $user->profile_image))) {
						unlink(public_path('profiles/' . $user->profile_image));
					}
					if(!file_exists(public_path('profiles'))) {
						mkdir(public_path('profiles'), 0755, true);
					}
					
					
					$filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
					$image->move(public_path('profiles'), $filename);
					$user->profile_image = $filename;
					
				}
				
				
				$user->save();

				return redirect()
					->back()
					->with('success', 'Profile updated successfully.');

			} catch (\Exception $e) {

				return redirect()
					->back()
					->with('error', 'Something went wrong: ' . $e->getMessage());
			}
		
	}
}

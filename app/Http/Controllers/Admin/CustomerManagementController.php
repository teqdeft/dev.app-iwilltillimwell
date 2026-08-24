<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use App\Models\OrganizationsReward;
use Exception;
use Config;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class CustomerManagementController extends Controller
{
    public function index(Request $request)
    {
        
        $status = $request->get('status');
        $sortBy = $request->get('sort_by', 'users.id');
        $sortOrder = $request->get('sort_order', 'desc');
        $search = $request->get('search', '');
        $organization = $request->get('organization', '');
        
        $query = User::query();
        $query->whereNull('users.parentId');
        if ($status == 'active') { $query->where('users.payment_status', 1);}
        if(isset($organization) && !empty($organization)) {
            $query->where('organizations.id', $organization);
        }

        $query->where(function ($query) use ($search) {
           
            $query->where('users.fname', 'like', '%' . $search . '%')
                  ->orWhere('users.lname', 'like', '%' . $search . '%')
                  ->orWhere('users.email', 'like', '%' . $search . '%')
                  ->orWhere('organizations.name', 'like', '%' . $search . '%')
                  ->orWhere('users.primaryPhone', 'like', '%' . $search . '%');
        });

        $query->leftJoin('promocodes', 'promocodes.id', '=', 'users.promo_code_id');
        
        $query->leftJoin('users as b', 'b.id', '=', 'promocodes.influencer_id');
        $query->leftJoin('organizations', 'organizations.id', '=', 'b.organization_id');
        
        $query->select(
                'users.id',
                'users.fname',
                'users.lname',
                'users.email',
                'users.primaryPhone',
                'users.payment_status',
                'users.promo_code_id',
                'users.created_at',
                'users.expiry_date',
                'promocodes.influencer_id',
                'b.id as in_id',
                'organizations.name as organizations_name'
            );
            
        $customer_list = $query->orderBy($sortBy, $sortOrder)->paginate(50);

        if ($request->isMethod('post')) {
            return response()->json([
                'html' => view('admin.customer.customer_table', compact('customer_list', 'sortBy', 'sortOrder', 'search','status'))->render(),
                'pagination' => $customer_list->links()->render()
            ]);
        } else {
            $organization = Organization::all();
            return view('admin.customer.index', compact('customer_list', 'sortBy', 'sortOrder', 'search','status','organization'));
        }                    
        
    }

    public function customersEnrollDisernrolledList(Request $request) {

        $customer_list = User::whereIn('id', $request->user_ids)->orderBy("id","ASC")->get();
        return response()->json([
            'html' => view('admin.customer.customers-enroll-disernrolled-list', compact('customer_list'))->render()
        ]);
    }

    public function customersEnrollDisernrolledListAPI(Request $request) {
        
       
        $ajax_response = [];
        try {
            $reg_res = "Success";
            $user = User::where("id", $request->u_id)->select("id", "groupCode")->first();
            if (!$user) {
                throw new Exception("User not found with the given ID.");
            }
            $tele_data['primaryExternalId'] = $user->id;
            $tele_data['groupCode']  = $user->groupCode;
            
        
            if($request->request_type=="Disenroll") {
                $tele_data['terminationDate']  =  date("m/d/y", strtotime("+1 day"));
                $post_url = Config::get('constants.tel_api_url') ."census/updateTerminationDate";
            } else {

                $effectiveDate = date("m/d/y", strtotime("+1 month"));
                $tele_data['effectiveDate']  =  $effectiveDate;
                $post_url = Config::get('constants.tel_api_url') ."census/updateEffectiveDate";

            }

            //$tele_data['terminationDate']  = "04/04/2025";
            if(empty(Session::get('authorization'))) {
                (new ConsultationController)->apiAuthentication();
            }
            
            $response = (new ConsultationController)->postToteleMedicine($tele_data, $post_url, true, true);
            if(isset($response['success']) && $response['success'] == 1) {
                $remark = '<p style="color:green">Done</p>';
                $ajax_response['success'] = "success";

                if($request->request_type=="Disenroll") {
                    $user->payment_status=0;
                    $user->step_position=2;
                    $user->expiry_date = date('Y-m-d');
                    
                } else {
                    $user->payment_status=1;
                    $user->expiry_date = date('Y-m-d',strtotime($effectiveDate));
                }
                $user->save();

            } else {
                $ajax_response['success'] = "faild";
                $remark = '<p style="color:red; float: left; flex: 1; overflow-wrap: break-word; white-space: normal;">'.$response['message'].'</p>';
            }
           
            $ajax_response['remark'] = $remark;

        } catch (Exception $e) { 
            $ajax_response['success'] = "faild";
            $ajax_response['remark'] =$e->getMessage();
            
        }
        echo json_encode($ajax_response);
    }
	
	public function groupOrganization(Request $request) {
		
		//$group_organization = DB::table("organizations")->orderBy("id", "desc")->get();
		
		$group_organization = DB::table('organizations as a')
						->leftJoin('users as b', 'a.id', '=', 'b.organization_id')
						->where("b.user_role","influencer")
						->whereNull('a.deleted_at')
						->select(
							'a.id',
							'a.name',
							'a.group_email',
							'a.group_analytics',
							'a.created_at',
							'b.id as influencers_id'
						)
						->paginate(10);
		
		return view('admin.customer.group-organization', compact('group_organization'));
	}
	public function groupOrganizationReward(Request $request) {
		
		//$group_organization = DB::table("organizations")->orderBy("id", "desc")->get();
		
		$group_organization = DB::table('organizations as a')
						->leftJoin('users as b', 'a.id', '=', 'b.organization_id')
						->where("b.user_role","influencer")
						->select(
							'a.id',
							'a.name',
							'a.group_email',
							'a.group_analytics',
							'a.created_at',
							'b.id as influencers_id'
						)
						->paginate(10);
		
		return view('admin.customer.group-organization-reward', compact('group_organization'));
	}
	public function groupOrganizationCommissionHistory(Request $request) {
		
		$influencers_id = $request->user_id ?? '0';
		
		//$group_organization = DB::table("organizations")->orderBy("id", "desc")->get(); 
		
		$OrderHistory = DB::table('braintree_subscription as a')
					->leftJoin('promocodes as b', 'a.promo_code_id', '=', 'b.id')
					->where('b.influencer_id', $influencers_id)
					->selectRaw("
						DATE_FORMAT(a.created_at, '%Y-%m') AS months,
						DATE_FORMAT(MIN(a.created_at), '%M, %Y') AS display_months,
						SUM(a.commission_amount) AS total_commission
					")
					->groupByRaw("DATE_FORMAT(a.created_at, '%Y-%m')")
					->havingRaw('SUM(a.commission_amount) > 0')
					->orderByRaw("months DESC")
					->paginate(10);
		
		return view('admin.customer.group-organization-commission-history', compact('OrderHistory'));
	}
	
	public function groupOrganizationSave(Request $request) {
		

		$updated = DB::table('organizations')
        ->where('id', $request->group_id)
        ->update([
            'name' => $request->name,
            'group_email' => $request->group_email,
            'group_analytics' => $request->group_analytics,
            'updated_at' => now(),
        ]);
		
		if ($updated) {
			return response()->json([
				'success' => true,
				'message' => 'Group updated successfully.'
			]);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'No changes were made.'
			]);
		}

	}
	
	public function groupOrganizationLoginSave(Request $request) {
		

		 $validator = Validator::make($request->all(), [
			'fname'     => 'required|string|max:255',
			'lname'     => 'required|string|max:255',
			'password'  => 'required|min:6'
		]);
		
		if($validator->fails()) {
			return response()->json([
				'status'  => false,
				'message' => $validator->errors()->first()
			], 422);
		}
		
		$user_role = 'group_organization';
		 try {
			
			
			$user = DB::table('users')->where('email', $request->email)->first();
			if($user) {
				
				
				DB::table('users')->where('email', $request->email)->update([
					'fname'      => $request->fname,
					'lname'      => $request->lname,
					'password'   => Hash::make($request->password),
					'updated_at' => now(),
				]);

				return response()->json([
					'status'  => true,
					'message' => 'User updated successfully',
					'data'    => $user
				]);

			
			} else  {
			
				/* $user = User::create([
					'fname'     => $request->fname,
					'lname'     => $request->lname,
					'email'     => $request->email,
					'user_role' => $user_role,
					'password'  => Hash::make($request->password),
				]); */

				return response()->json([
					'status'  => false,
					'message' => "Add Section Block"
				], 422);
			
			}

		} catch (\Exception $e) {

			return response()->json([
				'status'  => false,
				'message' => $e->getMessage()
			], 500);
		}
		
	}
	
	
	public function grouporganizationloginhtml(Request $request) {
		
		$group_email = $request->group_email;
		$user = DB::table('users')->where('email', $group_email)->first();
		$html = view('admin.customer.organization-login-html', compact('user','group_email'))->render();
		return response()->json([
			'status' => true,
			'html'   => $html
		]);
		
	}
	
	public function groupOrganizationRewardStore(Request $request) {
		
		$validator = Validator::make($request->all(), [
            'min' => 'required|numeric',
            'max' => 'required|numeric|gt:min',
            'year' => 'required|numeric',
            'commission' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        OrganizationsReward::create([
            'min' => $request->min,
            'max' => $request->max,
            'year' => $request->year,
            'commission' => $request->commission,
            'organization_id' => $request->organization_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Reward added successfully'
        ]);
		
	}
	public function groupOrganizationRewardStoreList(Request $request) {
		
		$organization_id = $request->organization_id;
		$rewards = OrganizationsReward::where('organization_id',$organization_id)->orderBy('id', 'asc')->get();

		return response()->json([
			'status' => true,
			'data' => $rewards
		]);
	}
	
	public function destroy($id)
		{
			$reward = OrganizationsReward::find($id);

			if(!$reward) {
				return response()->json([
					'status' => false,
					'message' => 'Reward not found!'
				], 404);
			}

			$reward->delete();

			return response()->json([
				'status' => true,
				'message' => 'Reward deleted successfully'
			]);
		}


}

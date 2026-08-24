<?php

namespace App\Http\Controllers\Affiliate;

use DB;
use Auth;

use Config;
use Session;
use stdClass;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\States;
use App\Models\Timezones;

use App\Mail\UserRegister;
use App\Models\ActivityLog;
use App\Traits\ApiResponse;
use App\Exports\UsersExport;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Exports\UsersErrorExport;

use App\Mail\CreateInfluencerMail;
use App\Interfaces\CommonConstants;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CommissionTransaction;
use App\Validators\AdminManagerValidator;
use App\Validators\User\ProfileValidator;
use App\Validators\User\RegisterValidator;
use App\Http\Controllers\ConsultationController;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UserController extends Controller implements CommonConstants
{
    use ApiResponse;
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, $id)
    {
        $user = $request->user();
        $language_options = config('constants.languages');

        $timezone = Timezones::all();
        $role     = Role::where('status', 1)->get();
        $state    = States::all();
        $userData = User::find($id);
        return view('admin.users.create', compact('user', 'language_options', 'timezone', 'state', 'role', 'userData'));
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $language_options = config('constants.languages');

        $timezone = Timezones::all();
        $role = Role::where('status', 1)->get();
        $state = States::all();

        return view('admin.users.create', compact('user', 'language_options', 'timezone', 'state', 'role'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();

        try {
            DB::beginTransaction();
            $input = $request->all();
            $userUpdateValidator = new ProfileValidator('update');

            if (!$userUpdateValidator->with($input)->passes()) {
                if ($request->wantsJson() || $request->ajax()) {
                    $response = [
                        'error'     => Response::HTTP_UNPROCESSABLE_ENTITY,
                        'message'   => $userUpdateValidator->getErrors()[0],
                        'messages'  => $userUpdateValidator->getErrors()
                    ];
                    return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                $request->session()->flash('error', $userUpdateValidator->getErrors()[0]);
                return back()
                    ->withErrors($userUpdateValidator->getValidator())
                    ->with([
                        'message'   => $userUpdateValidator->getErrors()[0],
                        'alert-type' => 'error'
                    ])
                    ->withInput();
            }

            $data = $input;

            if (isset($data['password']) && $data['password']) {
                if (Hash::check($data['current_password'], $user->password)) {
                    $user->password = Hash::make($data['password']);
                } else {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['current_password' => trans('messages.old_password_error')]);
                    // throw new \Exception(trans('messages.old_password_error'), 1);
                }
            }

            $user->name = $data['name'];
            $user->language = $data['language'];
            $user->save();

            app()->setlocale($data['language']);
            DB::commit();

            $response = [
                'success' => Lang::get('messages.user_profile_update')
            ];

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json($response);
            }
            return redirect()->route('admin-dashboard')->with($response);
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'error'     => $e->getMessage()
            ];
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return back()->with($response)->withInput();
        }
    }

    /**
     * Show the listing for each user.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        if ($request->type == 'xlsx')
        return Excel::download(new UsersExport,  date("Y-m-d") . "-user-data.xlsx");
        else
        return Excel::download(new UsersExport,  date("Y-m-d") . "-user-data.csv");
    }

    public function importSubscriber(Request $request){
        if($request->file('uploadSheet')){
            $rows = Excel::toArray(new stdClass(), $request->file('uploadSheet'));
            $userData = removeEmptyRows($rows);
            $error = [];
            $allState = States::all()->toArray();
            $timeStand = Timezones::all()->toArray();

            if (empty(Session::get('authorization'))) {
                (new ConsultationController)->apiAuthentication();
            }

            if( isset($userData) && !empty($userData) ){
                foreach($userData as $key => $value){
                    if( $key >= 5 && $key <= 9  ){
                        $groupId = checkSubscription($userData,5,9);
                        if( !$groupId ){
                            $request->session()->flash('error', 'Select Service Bundle');
                            return redirect()->back();
                        }
                    }


                    if( $key > 11 ){   
                        extract(extractImportData($value));
                        /*  start to 0 condition */
                        $errorIndex = (count($value)-1);
                        $timeZone = checkTimezone($timeStand,$value[11]);

                        if( checkEmptyColumn($value,$errorIndex) ){
                            $value[2] = Date::excelToDateTimeObject($value[2])->format('d/m/Y');
                            $value[$errorIndex] = 'Required all fields';
                            $error[] = $value; 
                            continue;
                        }
                        if(User::where('email',$email)->count() > 0){
                            $value[2] = Date::excelToDateTimeObject($value[2])->format('d/m/Y');
                            $value[$errorIndex] = 'Email Exist already';
                            $error[] = $value;
                            continue;     
                        }
                        $stateid = getStateId($allState,$state);
                        if( empty($stateid) ){
                            $value[2] = Date::excelToDateTimeObject($value[2])->format('d/m/Y');
                            $value[$errorIndex] = 'State not exist';
                            $error[] = $value;
                            continue;
                        }
                        
                        if( !$timeZone ){
                            $value[2] = Date::excelToDateTimeObject($value[2])->format('d/m/Y');
                            $value[$errorIndex] = 'Time Zone not matched';
                            $error[] = $value;
                            continue;
                        }
 
                        $userDetails = extractImportData($value);
                        unset($userDetails['state']);

                        
                        $userDetails = $userDetails + ['parentId' => Auth::user()->id] +  ['stateid' => $stateid,'planDetailsId' => 3,
                                        'timezoneId' => $timeZone,'school_name' => $userData[1][1],
                                        'school_address' => $userData[2][1],
                                        'school_contact' => $userData[3][1],'planid' => $groupId,
                                        'school_member' => $value[1],'school_year' => $value[12],
                                        'expiry_date'   => date('Y-m-d', strtotime('+50 years'))
                                    ];
                        DB::beginTransaction();
                        try{
                            $user_id   = DB::table('users')->insertGetId($userDetails);
                            $post_url  = Config::get('constants.tel_api_url') . 'census/createMember';
                            $password  = $userDetails['fname'].rand(100000,999999);

                            $tele_data = telemedicineArray(($userDetails + ['id' => $user_id, ] ),$password);
                            $response = (new ConsultationController)->postToteleMedicine($tele_data, $post_url, true, true);
                            
                            if ($response['success'] == 1 ) {
                                $tele_data = ['password' => Hash::make($password) ] + $tele_data + ['step_position' => 4,'userid' =>  (string) $response['userid'], 'user_password' => base64_encode($password),
                                    'payment_status' => 1 ,'plan' => self::ORGANIZATIONID  ];
                                unset($tele_data['firstname'],$tele_data['lastname'],$tele_data['heightFeet'],
                                      $tele_data['heightInches'],
                                      $tele_data['weight']
                                );

                                $updateUser = DB::table('users')->where(['id' => $user_id])->update($tele_data);
                                
                                if( $updateUser ){
                                    $data = Mail::to($tele_data['email'])->send(new UserRegister($tele_data['email'],$password, 
                                                                $userDetails['name']));
                                    DB::commit();
                                }else{
                                    $value[2] = Date::excelToDateTimeObject($value[2])->format('d/m/Y');
                                    $value[$errorIndex] = 'Subscriber not updated';
                                    $error[] =  $value;
                                    DB::rollback();     
                                }
                            }else{
                               $value[2] = Date::excelToDateTimeObject($value[2])->format('d/m/Y');
                               $value[$errorIndex] = $response['message'];
                               $error[] = $value;
                               
                               DB::rollback();
                            }
                        }catch(\Exception $e){
                            $value[2] = Date::excelToDateTimeObject($value[2])->format('d/m/Y');
                            $value[$errorIndex] = $e->getMessage();
                            $error[] = $value;
                            DB::rollback();
                        }
                        /*  end to 0 condition */
                    }
                }

            }
            if( $error ){
                return Excel::download(new UsersErrorExport($error),  'users-not-insert.xlsx'); 
            }

            return redirect()->back()->with('Data successfuly added');


        }
    }

    /**
     * Show the listing for each user.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {

        $userObj = new User;
        $users = $userObj->where([
            'parentId' => Auth::user()->id,
            'payment_status' => 1,
            'user_role' => 'user',

            
        ])->where('user_role', '!=', 'admin')
            ->where('id', '!=', Auth::user()->id)
            ->orderBy('id', 'desc')->get();
        
        if ($request->wantsJson() || $request->ajax()) {
            $jsonCollection = collect(); 
            $users->each(function ($item, $key) use ($jsonCollection) {
                $data = [
                    'sr_no' => $key + 1,
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email,
                    'primaryPhone' => $item->primaryPhone ? $item->primaryPhone : "-",
                    'status' => $item->status == "1" ? "Active" : "Inactive",
                ];
                
                $jsonCollection->push($data);
            });
            return response()->json(['data' => $jsonCollection]);
        }
        $organization = Organization::all();

        return view('affiliate.student', compact('users','organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('activityLogs')->where('id',$id)->first();
        $state = States::where('id', $user->stateid)->first();
        $timezone = Timezones::where('id', $user->timezoneId)->first();
        $activityLogs = ActivityLog::where('user_id',$id)->get();
        //$subscription = Subscription::where('user_id',$user->timezoneId)->latest('created_at')->first();

        return view('affiliate.show', compact('user', 'state', 'timezone'));
    }

    /**
     * Update the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function status_managment($id, $status)
    {
        $update_status = User::where('id', $id)->update(['status' => $status]);
        if ($update_status) {
            return redirect()->back()->with('success', 'User Status updated successfully');
        } else {
            return redirect()->back()->with('success', 'Error please try again');
        }
    }

    /**
     * Show the listing for each influencer.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function getInfluencers(Request $request)
    {

        $userRole = self::AFFILIATE;
        if (in_array('influencers', $request->segments()) && in_array('counsellor', $request->segments())) {
            $userRole = self::COUNSELLOR;
        }

        $influencers = User::where([
            'user_role' => $userRole,
            'deleted_at' => NULL,
        ])->orderBY('id', 'DESC')->get();

        if ($request->wantsJson() || $request->ajax()) {

            $jsonCollection = collect();
            $influencers->each(function ($item, $key) use ($jsonCollection) {
                $organization = "N/A";
                if ($item->organization_id) {
                    $get_organization =  Organization::where('id', $item->organization_id)->first();
                    $organization = $get_organization->name;
                }
                $influencer_payable_amount = 0;
                if (CommissionTransaction::where('influencer_id', $item->id)->exists()) {
                    $influencer_payable_amount = CommissionTransaction::where(array('influencer_id' => $item->id, 'status' => '0'))->sum('influencer_payable_amount');
                }

                $jsonCollection->push([
                    'sr_no' => $key + 1,
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email,
                    'primaryPhone' => $item->primaryPhone ? $item->primaryPhone : "-",
                    'organization' => $organization,
                    'influencer_payable_amount' => $influencer_payable_amount ? $influencer_payable_amount : "N/A",
                ]);
            });
            return response()->json(['data' => $jsonCollection]);
        }
        return view('admin.influencer.index', compact('influencers'));
    }

    /*public function getCounsellor(){
       return view('admin.influencer.index', compact('influencers'));
    }*/

    /**
     * create influencer.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function createInfluencer()
    {
        return view('admin.influencer.create');
    }

    /**
     * User register.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeInfluencer(Request $request, RegisterValidator $registerValidator)
    {
        try {
            $input = $request->all();

            $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
            $password = substr($random, 0, 10);
            $input['password'] = $password;

            if (!$registerValidator->with($input)->passes()) {
                $request->session()->flash('error', $registerValidator->getErrors()[0]);
                return back()
                    ->withErrors($registerValidator->getValidator())
                    ->withInput();
            }

            $input['step_position'] = 2;
            //$input['user_role'] = 'influencer';
            $input['name'] = $input['fname'] . ' ' . $input['lname'];
            $input['password'] = Hash::make($input['password']);
            $input['user_password'] = base64_encode($password);



            if ((isset($input['organization'])) && (!empty($input['organization']))) {
                $organization_data = array(
                    'name' => $input['organization']
                );
                $organization = Organization::create($organization_data);
                $input['organization_id'] = $organization->id;
            }
            $user = User::create($input);

            if ($user) {
                $redirect = "";
                $msg = "Influencer";
                if ($input['user_role'] == 'counsellor') {
                    $redirect = "/counsellor";
                    $msg = "Counsellor";
                }

                Mail::to($input['email'])->send(new CreateInfluencerMail($input['email'], $password, $input['name']));
                $request->session()->flash('success', "{$msg} created successfully.");
                return redirect("/admin/influencers{$redirect}");
            } else {
                return redirect()->back()->with('success', 'Error please try again');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    // Delete Influencer //
    public function deleteInfluencer(Request $request, $id)
    {
        User::where('id', $id)->update(['deleted_at' => Carbon::now()]);
        $request->session()->flash('success', 'Influencer deleted successfully.');
        return redirect()->route('admin.influencers.get');
    }
    public function deleteCounseller(Request $request, $id)
    {
        User::where('id', $id)->update(['deleted_at' => Carbon::now()]);
        $request->session()->flash('success', 'Counseller deleted successfully.');
        return redirect('admin/influencers/counsellor');
    }
    // Get User Based on type //
    public function influencersWithType($type)
    {
        try {
            if ($type == 1) {
                $users = User::where(['user_role' => 'influencer', 'deleted_at' => NULL])->whereNull('organization_id')->get();
            } else {
                $users = User::where(['user_role' => 'influencer', 'deleted_at' => NULL])->whereNotNull('organization_id')->get();
            }

            if ($users) {
                $jsonCollection = collect();
                $users->each(function ($item, $key) use ($jsonCollection) {
                    $jsonCollection->push([
                        'id' => $item->id,
                        'name' => $item->name,
                        'organization' => $item->organization,
                    ]);
                });
                echo json_encode($this->successResponse([
                    "status" => true,
                    "data" => $jsonCollection,
                ]));
            } else {
                echo json_encode(
                    $this->failResponse([
                        "status" => false
                    ])
                );
            }
        } catch (\Exception $e) {
            echo json_encode($this->failResponse([
                "message" => $e->getMessage(),
            ], 500));
            die;
        }
    }

    /* public function transactionHistory(Request $request, $id)
    {
        try {
            $transactions = CommissionTransaction::where(['influencer_id' => $id])->get();
            if ($request->wantsJson() || $request->ajax()) {
                $jsonCollection = collect();
                $transactions->each(function ($item, $key) use ($jsonCollection) {

                    $jsonCollection->push([
                        'sr_no' => $key + 1,
                        'code' => $item->promocode->code,
                        'name' => $item->member->name,
                        'members_discount_amount' => $item->commission_amount,
                        'status' => $item->custom_status,
                    ]);
                });
                return response()->json(['data' => $jsonCollection]);
            }
            return view('admin.influencer.show', compact('transactions'));
        } catch (\Exception $e) {
            echo json_encode($this->failResponse([
                "message" => $e->getMessage(),
            ], 500));
            die;
        }
    }
 */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function transactionHistory(Request $request)
    {
        try {
            /*$user = $request->user();
            $transactions = CommissionTransaction::where(['influencer_id' => $user->id])->get();*/
            $user = $request->get('user_id');
            $transactions = CommissionTransaction::where(['influencer_id' => $user])->get();
            if ($request->wantsJson() || $request->ajax()) {
                $jsonCollection = collect();
                $transactions->each(function ($item, $key) use ($jsonCollection) {
                    $jsonCollection->push([
                        'sr_no' => $key + 1,
                        'code' => $item->promocode->code,
                        'name' => $item->member->name,
                        'members_discount_amount' => $item->commission_amount,
                        'status' => $item->custom_status,
                    ]);
                });
                return response()->json(['data' => $jsonCollection]);
            }

            return view('admin.transaction', compact('transactions'));
        } catch (\Exception $e) {
            echo json_encode($this->failResponse([
                "message" => $e->getMessage(),
            ], 500));
        }
    }

    /* store and update create users by admin */

    public function store(Request $request)
    {
        try {
            $adminManagerValidator = new AdminManagerValidator('', $request->id);
            $input = $request->all();

            if (!$adminManagerValidator->with($input)->passes()) {
                $request->session()->flash('error', $adminManagerValidator->getErrors()[0]);
                return back()
                    ->withErrors($adminManagerValidator->getValidator())
                    ->withInput();
            }

            $user = new User();
            $sessionMsg = 'User successfully created.';

            if (!empty($request->id)) {
                $user = $user->find($request->id);
                $sessionMsg = 'User successfully updated.';
            } else {
                $password = generateRandomString(10);
                $user->email         = $request->email;
                $user->password      = Hash::make($password);
                $user->user_password = base64_encode($password);
            }

            $admin_manager = 0;
            $user_role = 'user';
            $redirect = 'subscriber';
            if( $request->user_role ){
                $admin_manager = $request->user_role;
                $user_role = 'others';
                $redirect = 'employee';
            }

            $user->name           = "{$request->first_name} {$request->last_name}";
            $user->fname          = $request->first_name;
            $user->lname          = $request->last_name;
            $user->gender         = $request->genders;
            $user->timezoneId     = $request->timezone;
            $user->zipCode        = $request->zipcode;
            $user->stateid        = $request->state;
            $user->address        = $request->address;
            $user->city           = $request->city;
            $user->primaryPhone   = $request->primaryphone;
            $user->user_role      = $user_role;
            $user->admin_managers = $admin_manager;
            $user->payment_status = 1;
            if ($user->save()) {
                if (empty($request->id)) {
                    Mail::to($request->email)->send(new CreateInfluencerMail($input['email'], $password, $user->name));
                }
            }

            Session::flash('success', $sessionMsg);
            return redirect(route('admin.users.'.$redirect));
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }


    
    
}

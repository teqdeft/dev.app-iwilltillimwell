<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;



use Illuminate\Support\Facades\Redirect;



use App\Validators\User\ProfileValidator;

use App\Validators\User\RegisterValidator;

use App\Validators\User\DependentValidator;



use App\Mail\AccessCode;

use App\Jobs\SendEmailJob;

use App\Mail\PasswordUpdate;

use App\Mail\CreateDependent;

use App\Traits\ApiResponse;

use App\Models\User;

use App\Models\UserMeta;

use App\Models\UserPharmacy;



use Laravel\Cashier;



use Stripe\StripeClient;

use App\Models\States;

use App\Http\Controllers\ConsultationController;

use Illuminate\Support\Facades\DB;

use Image;

use Lang;

use Illuminate\Support\Facades\Auth;

use Stripe;

use App\Models\Timezones;

use App\Models\Plan;

use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Session;



use View;

use Braintree;

use Carbon\Carbon;

use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Crypt;

use Laravel\Sanctum\PersonalAccessToken;

use Illuminate\Support\Facades\Validator;



use Modules\{

    SharingPreference\Models\SendToFriendList

};



class UserController extends Controller

{

    use ApiResponse;

    	/**

     * Create a new controller instance.

     *

     * @return void

     */

    	public function __construct()

    	{

            $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        }



    /**

     * Get the user register.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request, RegisterValidator $registerValidator)

    {

        try {

            

            $input = $request->all();

			

			unset($input['timezoneId']);

			



            if (!$registerValidator->with($input)->passes()) {

                echo json_encode($this->failResponse([

                    "message" => $registerValidator->getErrors()[0],

                    "messages" => $registerValidator->getErrors()

                ], 422));

                die;

            }

            // NOTE: removed the telemedicine validateEmail() call here. Its result
            // was never used during registration, but the (slow / unreachable on
            // dev) external API call blocked sign-up and made it hang. Duplicate
            // emails are still blocked by the unique:users validator and the
            // local lookup below.

            $data = User::where('email', '=', $input['email'])->first();

            if ($data ) {

                echo json_encode($this->failResponse([

                    "message" => "The email has already been taken.",

                    "payment_status" => $data ? $data->payment_status : 0,

                    "user_status" => $data ? $data->status : 0,

                    "tele_userid" => $data ? $data->userid : null,

                ], 409));

                return redirect()->back()->with('error', 'email already exits');   

            }



            $password = $input['password'];

            $input['step_position'] = 2;

            $input['name'] = $input['fname'] .' '. $input['lname'];

            $input['password'] = Hash::make($input['password']);

            $input['user_password'] = base64_encode($password);

            $input['access_site'] = json_encode(['iwilltilimwell']);



            $user = User::create($input);

            //$user->save();

            // Persist the landing-promo association on the user (e.g. arrived via
            // /register?promo=NABV000). This keeps the campaign plan view + discount
            // working across FUTURE logins, not just the current session, because
            // the session is cleared on logout.
            $landingCode = session('landing_promo');
            if ($landingCode) {
                $landingPromo = \App\Models\Promocode::where('code', $landingCode)->first();
                if ($landingPromo) {
                    $user->promo_code_id = $landingPromo->id;
                    $user->save();
                }
            }

            Auth::login($user);

            if (Auth::attempt(['email' => $input['email'], 'password' => $password])) {

                $data = array();

                echo json_encode($this->successResponse([

                    "message" => 'Registration success',

                    "data" => $user

                ]));

            }

        } catch (\Exception $e) {

            echo json_encode($this->failResponse([

                "message" => $e->getMessage(),

            ], 500));

            die;

        }

    }





    public function storeAwmi(Request $request, RegisterValidator $registerValidator)

    {

        try {



            $input = $request->all();



            if (!$registerValidator->with($input)->passes()) {

                return redirect()->back()->with('error', $registerValidator->getErrors()[0]);

            }

     

            // validate email on tele medicine //

            

            $result = (new ConsultationController)->validateEmail($input['email']);

            $data = User::where('email', '=', $input['email'])->count();



	        $valid_email = isset($result['availableForUse']) ? $result['availableForUse'] : false;



            if ($data > 0) {

                return redirect()->back()->with('error', 'The email has already been taken.');  

            }



            $password = $input['password'];

            $input['step_position'] = 2;

            $input['name'] = $input['fname'] .' '. $input['lname'];

            $input['password'] = Hash::make($input['password']);

            $input['user_password'] = base64_encode($password);

            $input['access_site'] = json_encode(['iwilltilimwell']);

            $input['awmi_family'] = 1;



            $user = User::create($input);



            $userId = $user->id;

            $um_key = 'awmi_priceCheck';



            if( $userId) {

                UserMeta::create(['user_id' => $userId,'prefix'=> 'awmi','meta_key' => $um_key,'meta_value' => 0]);

            }



            $request->session()->put('awmiUser', 'user_loggedIn');

            

            if (Auth::attempt(['email' => $input['email'], 'password' => $password])) {

                return redirect('awmi-pricing');

            }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());  

        }

    }















    

    public function showRegistrationForm() {



        //dd(session()->all());

        $awmi_session = Session::get('awmiUser');

        

        if ($awmi_session) {

            return redirect('/');

        }



        $plans = $this->stripe->plans->all();

        // $intent = $user->createSetupIntent();

        $states = States::all();

        $timezones = TimeZones::all();



        $AWMIuser = array("name"=>"AWMI user","type"=>"AWMI");



        Session::put('fromAWMI', $AWMIuser);

        return view("auth.awmi-register", compact(["plans", "states", "timezones"]));



        //$jsession = Session::get('fromAWMI');

        // print_r($jsession );



    }







    



    function checkEmailExist(Request $request){

        $input  = $request->all();

        // Is the email already registered in our system? This mirrors exactly the
        // rule the server enforces at registration (unique:users). We no longer
        // depend on the telemedicine API here, because when that API is
        // unreachable it returned no `availableForUse` and made EVERY email look
        // "already taken", blocking all sign-ups.
        $user = User::where('email', $input['email'])->count();

        // jQuery-validate remote rule: 'true' = valid (email available),
        // 'false' = invalid (already taken).
        echo $user > 0 ? 'false' : 'true';

        exit();

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

            echo json_encode(['original' => ['status' => true]]);

            die;

            try {

              DB::beginTransaction();

              $input = $request->all();

              $userUpdateValidator = new ProfileValidator('update');



              if (!$userUpdateValidator->with($input)->passes()) {

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

                throw new \Exception(trans('messages.old_password_error'), 1);

            }

        }



        $user->name = @$data['name'];

        $user->save();



        DB::commit();



        $response = [

           'success' => Lang::get('messages.user_profile_update')

       ];



       if ($request->wantsJson() || $request->ajax()) {

           return response()->json($response);

       }

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

     * Get the user profile.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function cancelSubscription(Request $request)

    {

    	$input = $request->all();

    	$user = Auth::user();

    	try{

    		if(isset($input['plan_name']) && ($input['plan_name'])){

    			$user->subscription($input['plan_name'])->cancel();

    		}

    		return redirect('profile');

    	} catch (\Exception $e) {

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

     * Get the user profile.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function subscribers(Request $request)

    {

    	$stripe = new \Stripe\StripeClient(

    		env('STRIPE_SECRET')

    	);

    	$subscribers = Cashier\Subscription::query()->orderBY('id', 'desc')->get();

    	$user = Auth::user();

    	return view('subscribers',compact('user','subscribers'));

    }



    /**

     * Get the updateStep.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function updateStep(Request $request) {

        try {

            $input = $request->all();

            $user = User::where('email', '=', $input['email'])->first();

           

            if(isset($input['select_plan'])) {  

				

				$package_service_list = getPackageServiceList($input['select_plan']);

				$package_service_list = array_unique(array_filter($package_service_list));

                $bundle_id = getMatchedBundleAccordingServices($input['select_plan'],$package_service_list);

				if(empty($bundle_id)) {

                    echo json_encode($this->failResponse(["message" =>"Sorry No Service. Please Choose Another Option"], 500));

                    exit();

                }

				$package_service_list = implode(",",$package_service_list);

                UserMeta::CustomeUpdateInsert('optional_service',$input['optional_service']);

                UserMeta::CustomeUpdateInsert('optional_amount',$input['optional_amount']);

                UserMeta::CustomeUpdateInsert('package_service_list',$package_service_list);

                UserMeta::CustomeUpdateInsert('plan_tab',$input['plan_tab']);

                UserMeta::CustomeUpdateInsert('bundle_id',$bundle_id);

				

				$user->stripe_planid = $input['select_plan'];

				$user->plan = $input['select_plan'];

				

            }





            $current_step = isset($input['current_step']) ? $input['current_step'] : $user->step_position;

            if ($current_step!=2) {

                $registerValidator = new RegisterValidator('update');

                if (!$registerValidator->with($input)->passes()) {

                    echo json_encode($this->failResponse([

                        "message" => $registerValidator->getErrors()[0],

                        "messages" => $registerValidator->getErrors()

                    ], 422));

                    die;

                }

            }

            //echo $user;

            //die;



            /* if(isset($input['select_plan'])) {

                $user->stripe_planid = $input['select_plan'];

                $user->plan = $input['select_plan'];

            } */

            $user->step_position = $input['next_step'];



             if(isset($input['fname'])) {

                $user->fname = $input['fname'];

            }

              if(isset($input['lname'])) {

                $user->lname = $input['lname'];

            }



            if(isset($input['primaryPhone'])) {

                $user->primaryPhone = $input['primaryPhone'];

            }

            if(isset($input['zipCode'])) {

                $user->zipCode = $input['zipCode'];

            }

            if(isset($input['address'])) {

                $user->address = $input['address'];

            }

            if(isset($input['city'])) {

                $user->city = $input['city'];

            }

            if(isset($input['stateid'])) {

                $user->stateid = $input['stateid'];

            }

            if(isset($input['getPlanDetail'])) {

                $user->planDetailsId = $input['getPlanDetail'];

            }

            if(isset($input['dob'])) {

                //$user->dob = $input['dob'];

            }



            if(isset($input['promo_code_id'])) {

                $user->promo_code_id = $input['promo_code_id'];

            }



            if(isset($input['gender'])) {

                $user->gender = $input['gender'];

            }



            if(isset($input['timezoneId'])) {

                $user->timezoneId = $input['timezoneId'];

            }



        

            $user->save();

            if($user->step_position == 4) {

                /* $single = $this->stripe->plans->retrieve($user->stripe_planid);

                $user->stripe_plan_name = $single->nickname;

                $user->stripe_plan_price = $single->amount/100;

                $intent = $user->createSetupIntent();

                $user->client_secret = $intent->client_secret; */

            }

            $user_final_amount = GetFinalAmountOfPayment();

            echo json_encode($this->successResponse([

                "message" => 'Step updated successfully.',

                "user_final_amount"=>$user_final_amount,

                "data" => $user,

                

            ]));

            die;

        } catch (\Exception $e) {

            echo json_encode($this->failResponse([

                "message" => $e->getMessage(),

            ], 500));

            die;

        }

    }



    /**

     * Get the user profile.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function profile(Request $request)

    {

        

		

		

    	$user = $request->user();

    	$states = States::all();

        $timezones= Timezones::all();



        $userPaymentDetails = User::paymentDetails($user->id,$user->plan);



        if ($user->parentId) {

            $allDependent = DB::select('SELECT * FROM users WHERE (parentId='.$user->id.' or parentId='.$user->parentId.') and id <> '.$user->id.'');

        } else {

            $allDependent = DB::select('SELECT * FROM users WHERE parentId='.$user->id.' and id <> '.$user->id.'');

        }



        $pharmacy_state = "";



        if ($user->user_pharmcay) {

            $pharmacy_state_id = $user->user_pharmcay->stateid;

            $pharmacy_state = States::where('state_id', $pharmacy_state_id)->first();

        }



       /*  $data = $this->upgradePlanDetails($userPaymentDetails[0]['amount'] ?? false,$user->plan);

        $monthPlan = $data['monthPlan'];

        $clientToken = $data['clientToken']; */

	

        $monthPlan = 0;

        $clientToken = 0;



		

		

		$subscription_info = DB::table('braintree_subscription as a')

			->leftJoin('plans as b', 'a.plan_id', '=', 'b.id')

			->where('a.user_id', $user->id)

			->select('b.name', 'b.amount', 'b.plan_type', 'a.plan_id','a.subscription_start_date','a.subscription_end_date','a.terms_accepted','a.terms_accepted_at')

			->orderBy('a.id', 'desc')

			->first();

		

		

		

		$friendContact = SendToFriendList::getWhereData(['user_id' => $user->id]);

		

		$moduleName = [ ['name' => 'screen_history','label' => 'My Screening History' ,'sort' => 4 ],

                        ['name' => 'mood_history','label' => 'My Mood History','sort' => 3 ],

                        ['name' => 'my_mood','label' => 'My Daily Mood','sort' => 1 ],

                        ['name' => 'my_journal','label' => 'My Daily Journal','sort' => 2 ],

                        ['name' => 'my_safety','label' => 'My Safety Plan','sort' => 5 ],

                      ];

        $moduleName = array_values(Arr::sort($moduleName,function($value,$key){

            return $value['sort'];

        }));

		

		

		$transction_record = DB::table('braintree_subscription as a')

								->leftJoin('plans as b', 'a.plan_id', '=', 'b.id')

								->leftJoin('promocodes as c', 'a.promo_code_id', '=', 'c.id') // new join

								->where('a.user_id', $user->id)

								->orderByDesc('a.id')

								->select(

									'b.id as planid',

									'b.name',

									'a.amount',

									'a.optional_amount',

									'a.subscription_status',

									'a.subscription_start_date',

									'a.subscription_end_date',

									'a.subscription_type',

									'a.pro_rata_days',

									'a.pro_rata_amount',

									'a.terms_accepted',

									'a.terms_accepted_at',

									'a.final_amount',

									'a.promo_code_value',
                                    'a.payment_method',



									// promocode fields

									'c.code as promo_code'

								)

								->paginate(15);

	

		if($request->ajax()) {

			return view('auth.manage-transaction-history-table', compact('transction_record'))->render();

		}

        if(isMobile()) {

            return view('mobile.auth.my-account',compact('user','states','timezones', 'pharmacy_state', 'allDependent','userPaymentDetails','monthPlan','clientToken','subscription_info','friendContact','moduleName','transction_record'));

        }

		

		

        return view('auth.my-account',compact('user','states','timezones', 'pharmacy_state', 'allDependent','userPaymentDetails','monthPlan','clientToken','subscription_info','friendContact','moduleName','transction_record'));

		 

    }



    function upgradePlanDetails($amount,$planId){



        $plain = Plan::all();

		$monthPlan = [];

		$totalMonth = $arrayKey = "";

		foreach($plain as $key => $value){

			if( isset($value->planType->status) && $value->planType->status ){

				if( $value->interval == 'monthly' ){

					$arrayKey = 'One-Month';

					$totalMonth = 1;

				}elseif( $value->interval == 'Quarterly' ){

					$arrayKey = 'Three-Month';

					$totalMonth = 3;

				}

				if( $value->member_type == 1 ){

					$members = 'Self';

				}elseif( $value->member_type == 2 ){

					$members = 'Self + Family';

				}

				if( !empty($arrayKey) ){

					$monthPlan[$arrayKey]['month']   = str_replace('-',' ',$arrayKey);

					$monthPlan[$arrayKey]['members'][$value->member_type] = $members;

					$monthPlan[$arrayKey]['plans'][str_replace(' ','-',$value->planType->name)."_".$value->planType->id] = str_replace(' ','-',$value->planType->name);

					$monthPlan[$arrayKey]['price'][str_replace(' ','-',$value->planType->name)."_".$value->planType->id][$value->member_type]

                        = $value->toArray() + ['totalMonth' => $totalMonth,'selectedPlan' => (($value->id == $planId )?true:false) ];

				}

			}

		}



        $environment = env('BTREE_ENVIRONMENT');

		$gateway = new Braintree\Gateway([

			'environment' => $environment,

			'merchantId' => env('BTREE_MERCHANT_ID'),

			'publicKey' => env('BTREE_PUBLIC_KEY'),

			'privateKey' => env('BTREE_PRIVATE_KEY')

		]);

		$clientToken = $gateway->clientToken()->generate();

        

        return ['monthPlan' => $monthPlan,'clientToken' => $clientToken ];



    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\user  $user

     * @return \Illuminate\Http\Response

    */

    public function updateProfile(Request $request)

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

            $data['primaryPhone'] = Auth::user()->primaryPhone;

            //Save Data on Tele Medicine

            

            

            if ($user->parentId) {

                $user = Auth::user();

                $result = (new ConsultationController)->updateDenedentInfo($data,$user);

            } else {

                $result = (new ConsultationController)->updateGeneralInfo($data);

            }

            if($request->hasFile('profile_image')) {

				

				$validator = Validator::make($request->all(), [

							'profile_image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',

						], [

							'profile_image.image' => 'The file must be an image.',

							'profile_image.mimes' => 'Only JPEG, PNG, JPG, or GIF files are allowed.',

							'profile_image.max' => 'The image size must not exceed 2MB.',

						]);

				if($validator->fails()) {

					

					$response = [

						'error' => $validator->errors()->get('profile_image')[0] ?? 'Invalid file.'

					];

					return back()->with($response)->withInput();



				}	

				$image = $request->file('profile_image');

				if ($user->profile_image && file_exists(public_path('profiles/' . $user->profile_image))) {

					unlink(public_path('profiles/' . $user->profile_image));

				}

				if(!file_exists(public_path('profiles'))) {

					mkdir(public_path('profiles'), 0755, true);

				}

				$filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

				$image->move(public_path('profiles'), $filename);

				$user->profile_image = $filename;

			}

            

            // dd( date("m/d/Y", strtotime($data['dob'])));

            if($result['success']) {

				

				

				

				

                $user->fname = $data['fname'];

                $user->lname = $data['lname'];

                $user->address = $data['address'];

                $user->address2 = $data['address2'];

                $user->stateid = $data['stateid'];

                $user->dob = date("m/d/Y", strtotime($data['dob']));

                $user->city = $data['city'];

                $user->gender = $data['gender'];

                $user->zipCode = $data['zipCode'];

                $user->timezoneId = $data['timezoneId'];

                $user->primaryPhone = $data['primaryPhone'];

                $user->secondaryPhone = $data['secondaryPhone'];



                $user->save();



                DB::commit();



                $response = [

                    'success' => 'Profile updated successfully'

                ];



                return redirect()->route('my-account')->with($response);

            } else {

                $response = [

                    'error' => $result['message']

                ];

                 return back()->with($response)->withInput();

                die;

               

            }

        } catch (\Exception $e) {

            DB::rollback();

            $response = ['error'     => $e->getMessage()];

            if ($request->wantsJson() || $request->ajax()) {

                return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);

            }

            return back()->with($response)->withInput();

        }

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\user  $user

     * @return \Illuminate\Http\Response

     */

    public function updatePassword(Request $request)

    {

        $user = $request->user();



        try {

            DB::beginTransaction();

            $input = $request->all();

            $userUpdateValidator = new ProfileValidator('updatePassword');



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

                  //Save Data on Tele Medicine

                  if ($user->parentId) {

                        $user = Auth::user();

                        $result = (new ConsultationController)->updateDenedentInfo($data,$user,true);

                  } else {

                        $result = (new ConsultationController)->updateGeneralInfo($data, true);

                  }

                  //$result = (new ConsultationController)->updateGeneralInfo($data, true);

                  if($result['success']) {

                    $user->password = Hash::make($data['password']);

                    $user->user_password = base64_encode($data['password']);

                } else {

                    $response = [

                        'error' => $result['message']

                    ];

                    return back()->with($response)->withInput();

                }

            } else {

                return redirect()->back()

                ->withInput()

                ->withErrors(['current_password' => trans('messages.old_password_error')]);

                    // throw new \Exception(trans('messages.old_password_error'), 1);

            }

        }



        $user->save();

        DB::commit();



        $response = [

            'success' => 'Password updated successfully'

        ];

		

		$request->session()->flash('success', 'Password updated successfully');



        Mail::to($request->user())->send(new PasswordUpdate());

        return redirect('my-account')->with($response);

        

		

		} catch (\Exception $e) {

            DB::rollback();

            $response = [

                'error' => $e->getMessage()

            ];

            if ($request->wantsJson() || $request->ajax()) {

                return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);

            }

            return back()->with($response)->withInput();

        }

    }



     /**

     * Get the dependent register.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function addDependent(Request $request, DependentValidator $dependentValidator)

    {

        try {

            $input = $request->all();



            DB::beginTransaction();



            if (!$dependentValidator->with($input)->passes()) {

                $request->session()->flash('error', $dependentValidator->getErrors()[0]);

                return back()

                    ->withErrors($dependentValidator->getValidator())

                    ->withInput();

            }



            $user = $request->user();



            $input['name'] = $input['fname'] .' '. $input['lname'];

            $input['parentId'] = $user->id;

            $input['planid'] = Config::get('constants.planid');

            $input['groupCode'] = Config::get('constants.groupCode');

            $input['planDetailsId'] = $user->planDetailsId;

            $input['payment_status'] = 1;

            $input['step_position'] = 4;

            $input['access_site'] = $user->access_site;

			$filename = "";

			

			if($request->hasFile('profile_image')) {

				

				$validator = Validator::make($request->all(), [

							'profile_image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',

						], [

							'profile_image.image' => 'The file must be an image.',

							'profile_image.mimes' => 'Only JPEG, PNG, JPG, or GIF files are allowed.',

							'profile_image.max' => 'The image size must not exceed 2MB.',

						]);

				if($validator->fails()) {

					

					$response = [

						'error' => $validator->errors()->get('profile_image')[0] ?? 'Invalid file.'

					];

					return back()->with($response)->withInput();



				}	

				$image = $request->file('profile_image');

				if ($user->profile_image && file_exists(public_path('profiles/' . $user->profile_image))) {

					unlink(public_path('profiles/' . $user->profile_image));

				}

				if(!file_exists(public_path('profiles'))) {

					mkdir(public_path('profiles'), 0755, true);

				}

				$filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

				$image->move(public_path('profiles'), $filename);

				

				$input['profile_image'] = $filename;

				

				

			}

			

			



            // Member above 18

            if (isset($input['email']) && (!empty($input['email']))) {

                $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');

                $password = substr($random, 0, 10);

                $input['password'] = $password;

            }



            $data = $input;

            //Save Data on Tele Medicine

            $result = (new ConsultationController)->storeDependentInfo($data);

            

			

			if($result['success']) {

                $input['userid'] = $result['dependentUserId'];

                // Member above 18

                if (isset($input['email']) && (!empty($input['email']))) {

                    $input['user_password'] = base64_encode($password);

                    $input['password'] = Hash::make($password);

                }

				$input['profile_image'] = $filename;

                $user = User::create($input);

				DB::commit();

				

			

			

                

 

                if($user && isset($input['email']) && (!empty($input['email']))) {

                    Mail::to($input['email'])->send(new CreateDependent($input['email'], $password, $input['name']));

                }

                $response = [

                    'success' => 'Dependent added successfully'

                ];

                return redirect()->back();

            } else {

                $response = [

                    'error' => $result['message']

                ];

                return back()->with($response)->withInput();

            }



        } catch (\Exception $e) {

            echo json_encode($this->failResponse([

                "message" => $e->getMessage(),

            ], 500));

            die;

        }

    }

    /**

     * Get the user register.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function updateDependent(Request $request)

    {

        try {

            $input = $request->all();

            

             $parent_user = $request->user();

            DB::beginTransaction();



            $dependentValidator = new DependentValidator('update');

            if (!$dependentValidator->with($input)->passes()) {

                $request->session()->flash('error', $dependentValidator->getErrors()[0]);

                return back()

                    ->withErrors($dependentValidator->getValidator())

                    ->withInput();

            }

			

			$data = $input;

            $user = User::where('id', $input['dependent-id'])->first();

			

			if($request->hasFile('profile_image')) {

				

				$validator = Validator::make($request->all(), [

							'profile_image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',

						], [

							'profile_image.image' => 'The file must be an image.',

							'profile_image.mimes' => 'Only JPEG, PNG, JPG are allowed.',

							'profile_image.max' => 'The image size must not exceed 2MB.',

						]);

				if($validator->fails()) {

					

					$response = [

						'error' => $validator->errors()->get('profile_image')[0] ?? 'Invalid file.'

					];

					return back()->with($response)->withInput();



				}	

				$image = $request->file('profile_image');

				if($user->profile_image && file_exists(public_path('profiles/' . $user->profile_image))) {

					unlink(public_path('profiles/' . $user->profile_image));

				}

				if(!file_exists(public_path('profiles'))) {

					mkdir(public_path('profiles'), 0755, true);

				}

				$filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

				$image->move(public_path('profiles'), $filename);

				$user->profile_image = $filename;

				

				//dd($filename);

			}

			

			//die("////////////");

            

            //Save Data on Tele Medicine

            $result = (new ConsultationController)->updateDenedentInfo($data, $user);

            if($result['success']) {

				

                $user->fname = $data['fname'];

                $user->lname = $data['lname'];

                $user->email = isset($data['email']) ? $data['email'] : $user->email;

                $user->address = $data['address'];

                $user->address2 = $data['address2'];

                $user->stateid = $data['stateid'];

                $user->city = $data['city'];

                $user->gender = $data['gender'];

                $user->zipCode = $data['zipCode'];

                $user->timezoneId = $data['timezoneId'];

                $user->primaryPhone = $data['primaryPhone'];

                $user->secondaryPhone = $data['secondaryPhone'];

                $user->access_site = $parent_user->access_site;

                $user->save();



                DB::commit();



                $response = [

                    'success' => 'Dependent profile updated successfully'

                ];

                if(isMobile()) {

                    return redirect()->back()->with($response);

                }



                return redirect()->route('my-account')->with($response);

            } else {

                $response = [

                    'error' => $result['message']

                ];

                return back()->with($response)->withInput();

            }

        } catch (\Exception $e) {



            if(isMobile()) {

                return redirect()->back()->with($e->getMessage());

            }



            echo json_encode($this->failResponse([

                "message" => $e->getMessage(),

            ], 500));

            die;

        }

    }

    /**

     * Resend Register Email.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function resendDependentRegisterEMail(Request $request, $depedent_id)

    {

        try {

            $user = User::where("id",$depedent_id)->first();

            Mail::to($user->email)->send(new CreateDependent($user->email, base64_decode($user->user_password), $user->name));

			if(isMobile()) {

                return response()->json(['status'=>true,'message'=>'Email sent successfully']);

            }	

            return redirect()->back()->with('success', 'Email sent successfully');

        } catch (\Exception $e) {

			if(isMobile()) {

                return response()->json(['status'=>false,'message'=>$e->getMessage()]);

            }

            return redirect()->back()->with('error', $e->getMessage());

        }

    }



    /**

     * Update User Status.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function updateUserStatus(Request $request, $depedent_id)

    {

        try {

            if(empty(Session::get('authorization'))) {

                (new ConsultationController)->apiAuthentication();

            }

            $input = $request->all();

            $user = User::where("id",$depedent_id)->first();

			$user->status = $input['status'];

            $user->save();

			if(isMobile()) {

					return response()->json(['status'=>true,'message'=>'Dependent status updated successfully']);

			}

				

            return redirect()->back()->with('success', 'Dependent status updated successfully');

				

            /* if($input['status']==1) {

                $post_url = Config::get('constants.tel_api_url') .'census/updateEffectiveDate';

                $tele_data = array(

                            "groupCode" => Config::get('constants.groupCode'),

                            "primaryExternalId" => $depedent_id,

                            "effectiveDate" => date('m/d/Y'),

                        );

            } else {

                $post_url = Config::get('constants.tel_api_url') .'census/updateTerminationDate';

                $tele_data = array(

                            "groupCode" => Config::get('constants.groupCode'),

                            "primaryExternalId" => $depedent_id,

                            "terminationDate" => date('m/d/Y'),

                        );

            }

            $result = (new ConsultationController)->postToteleMedicine($tele_data, $post_url); */

            //prePrint($result);

           /*  if($result['success']) {  */

                

            /* } else {

                $response = [

                    'error' => $result['message']

                ];

                return back()->with($response)->withInput();

            } */

        } catch (\Exception $e) {

			if(isMobile()) {

					return response()->json(['status'=>false,'message'=>$e->getMessage()]);

			}

            return redirect()->back()->with('error', $e->getMessage());

        }

    }



    /**

     * update relationship.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function updateDependentRelationship(Request $request, $dependent_id)

    {

        try {

			

            $input = $request->all();

            DB::beginTransaction();

            $data = $input;

            $user = User::where('id', $dependent_id)->first();

            $result = (new ConsultationController)->updateDenedentInfo($data, $user);

            

			if($result['success']) {



                $user->relationship = $data['relationship'];



                $user->save();

                DB::commit();



                $response = [

                    'success' => 'Dependent relationship updated successfully'

                ];

				if(isMobile()) {

					return response()->json(['status'=>true,'message'=>'Dependent relationship updated successfully']);

				}

                return back()->with($response)->withInput();

            } else {

				

				if(isMobile()) {

					return response()->json(['status'=>false,'message'=>$result['message']]);

				}

				

                $response = [

                    'error' => $result['message']

                ];

                return back()->with($response)->withInput();

            }

        } catch (\Exception $e) {

			

			if(isMobile()) {

					return response()->json(['status'=>false,'message'=>$e->getMessage()]);

			}

				

            return redirect()->back()->with('error', $e->getMessage());

        }

    }



    /**

     * Srarch Pharmacy

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function searchPharmacy(Request $request)

    {

        try {

            $input = $request->all();



            DB::beginTransaction();

            $post_url = Config::get('constants.tel_api_url').'pharmacy/search?query='.urlencode($input['address']).'&zipCode='.$input['zipCode'].'';

			

            $state = States::where("id",$input['stateid'])->first();

            $state_abbr = $state ? $state->abbreviation : "";

            $tele_data = array(

                            "pharmacyname" => $input['name'] ? $input['name'] : "",

                            "pharmacyaddress" => $input['address'] ? $input['address'] : "",

                            "pharmacycity" => $input['city'] ? $input['city'] : "",

                            "pharmacystate" => $state_abbr,

                            "pharmacyzipCode" => $input['zipCode'] ? $input['zipCode'] : "",

                        );

			$tele_data = [];			

            $result = (new ConsultationController)->postToteleMedicine($tele_data, $post_url,false,false);

			

			

            // dd($result);

            if($result['success']) {



                $is_mobile = false;

                if(isMobile()){

                    $is_mobile = true;

                }



				$pharmacies = [];

				if(isset($result['pharmacies'])) {

					$pharmacies = $result['pharmacies'];

				}

				

				if(isset($result['suggestions'])) {

					$pharmacies = array_merge($pharmacies, $result['suggestions']);

				}

				if(isset($result['list'])) {

					$pharmacies = array_merge($pharmacies, $result['list']);

				}



                $html = view('pharmacy', compact('pharmacies','is_mobile'))->render();

		        return response()->json(['success' => true,'data' => $html]);

            } else {



                $getMessage='<div class="loca-phar-card" style="display: block;padding-bottom: 20px;"><div class="locat-detail">No record</div></div>';

                return response()->json(['success' => false,'data' =>$getMessage]);

            }

        } catch (\Exception $e) {

            

            $getMessage='<div class="loca-phar-card" style="display: block;padding-bottom: 20px;"><div class="locat-detail">'.$e->getMessage().'</div></div>';

            return response()->json(['success' => false,'data' =>$getMessage]);

 

        }

    }



    /**

     * Srarch Pharmacy

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function updatePharmacy(Request $request)

    {

        try {

            $input = $request->all();

            $user = Auth::user();



            DB::beginTransaction();

            $input['user_id'] = $user->id;

            $pharmacy = UserPharmacy::updateOrCreate(['user_id' => $user->id], $input);

            DB::commit();

            if ($pharmacy) {

                return response()->json(['success' => 'Pharmacy updated successfully']);

            } else {

                return response()->json(['error' => 'Please try again']);

            }



        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()]);

        }

    }



    // App User Login

    public function appUser(Request $request, $key) {

        try {

            $user_email= Crypt::decryptString($key);

            $user = User::where(array('email' => $user_email, 'status' => 1))->first();

            

            if ($user) {

                

                $result = (new ConsultationController)->validateEmail($user->email);

                // dd($result);

                if(isset($result['success']) && $result['availableForUse']){

                    Auth::login($user);

                    $reg_res = (new ConsultationController)->storeGeneralInfo($user);

                    // dd($reg_res);

                    if(isset($reg_res['success']) && $reg_res['success'] ){

                            // user registered

                             $response = (new ConsultationController())->setMemberSession($user);

                            if (isset($response['success'])) {

                                 // login user automatically

                                if (Auth::attempt(['email' => $user->email, 'password' => base64_decode($user->user_password)])) {

                                    $request->session()->flash('success', 'Login Successfully');

                                    return redirect('dashboard');

                                }

                            } else {

                                // Log the user out.

                                $this->logout($request);

                                return redirect()->back()

                                    ->withInput()

                                    ->withErrors([

                                        $this->username() => "Login failed with this email please contact with support",

                                    ]);

                            }

                        }

                }else{

                    $response = (new ConsultationController())->setMemberSession($user);

                    // dd($response);

                    Auth::login($user); // login user automatically

                    if (Auth::attempt(['email' => $user->email, 'password' => base64_decode($user->user_password)])) {

                        $request->session()->flash('success', 'Login Successfully');

                        return redirect('dashboard');

                    }

                }

            } else {

                $request->session()->flash('success', 'Login Successfully');

                return redirect('/');

            }

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()]);

        }

    }

    // Create influencer

    public function createInfluencer(Request $request) {

        try {



        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()]);

        }

    }



// start of functions for mobile view 



    public function checkPhoneExist(Request $request){

        $input  = $request->all();

        $userData   = User::where('primaryPhone',$input['phone'])->first();

        if (!$userData) {

            echo 'true';

            exit();

        }

        



        $result = (new ConsultationController)->validateEmail($userData['email']);

        $user   = User::where('email',$userData['email'])->count();

        if( empty($result['availableForUse']) || $user > 0  ){

            echo 'false';

        }else{

            echo 'true';

        }

        exit();

    }



    public function sendPhoneOtp(Request $request) {

        $request->validate([

            'phone' => 'required|numeric|digits:10',

        ]);



        $data = User::where('primaryPhone', '=', $request->phone)->first();

        if($data) {

            return response()->json([

                'success' => false,

                'message' => 'User already exists',

                'data' => '{}'

            ]);

        }

        

        if (Session::get('otp') && $request->phone == Session::get('actual_phone')) {

            

        }



        $phone = $request->phone;

        $countryCode = $request->country;

        $phoneWithCodeAsNum = $countryCode . $phone; 

        $phoneWithCode = "'". $phoneWithCodeAsNum ."'";

        

        $otp = rand(1000, 9999);



        Session::put('otp', $otp);

        Session::put('phone', $phoneWithCodeAsNum);

        Session::put('actual_phone', $phone);

        Session::put('otp_sent_at', now());



        $msg = "$otp is your OTP to register with iwilltilimwell. For any help please contact us."; 

        $phoneWithCode = "+1".$phone;

        $response = sendSmsViaTextBelt($phoneWithCode, $msg);



        $responseData = json_decode($response, true);

        if (isset($responseData['success']) && $responseData['success']) {

            

			/* $data->otp = $otp;

			$data->save(); */



			if(env('TEXT_BELT_MODE')=="active") {

				$otp=""; 

			}



            return response()->json([

                'success' => true,

                'message' => 'OTP sent successfully.',

                'data' => $responseData,

                'otp' => $otp

            ]);

        }



        return response()->json([

            'success' => false,

            'message' => 'Failed to send OTP.',

            'data' => '{}'

        ], 500);

    }

	

    public function resendOtpSignUp(Request $request) {

        $request->validate([

            'phone' => 'required|numeric|digits:10',

        ]);



       

        

        if (Session::get('otp') && $request->phone == Session::get('actual_phone')) {

            

        }



        $phone = $request->phone;

        $countryCode = $request->country;

        $phoneWithCodeAsNum = $countryCode . $phone; 

        $phoneWithCode = "'". $phoneWithCodeAsNum ."'";

        

        $otp = rand(1000, 9999);



        Session::put('otp', $otp);

        Session::put('phone', $phoneWithCodeAsNum);

        Session::put('actual_phone', $phone);

        Session::put('otp_sent_at', now());



        $msg = "$otp is your OTP to register with iwilltilimwell. For any help please contact us."; 

        $phoneWithCode = "+1".$phone;

        $response = sendSmsViaTextBelt($phoneWithCode, $msg);



        $responseData = json_decode($response, true);

        if (isset($responseData['success']) && $responseData['success']) {

            

			



			if(env('TEXT_BELT_MODE')=="active") {

				$otp=""; 

			}



            return response()->json([

                'success' => true,

                'message' => 'OTP sent successfully.',

                'data' => $responseData,

                'otp' => $otp

            ]);

        }



        return response()->json([

            'success' => false,

            'message' => 'Failed to send OTP.',

            'data' => '{}'

        ], 500);

    }



    public function sendPasscode(Request $request) {

        $request->validate([

            'digit1' => 'required|numeric|digits:1',

            'digit2' => 'required|numeric|digits:1',

            'digit3' => 'required|numeric|digits:1',

            'digit4' => 'required|numeric|digits:1',

        ]);



        $code = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4;

        if (strlen($code) == 4) {

            Session::put('passcode', $code);

            return response()->json([

                'success' => true,

                'message' => 'Passcode set successfully.',

                'data' => '{}',

            ]);

        }



        return response()->json([

            'success' => false,

            'message' => 'Failed to set.',

            'data' => '{}'

        ], 500);

    }



    public function resendOtp (Request $request) {

		

        try {

			

            $request->validate([

                'resend' => 'required',

                'phone_number_app' => 'required',

            ]);

			

			$user = User::where('primaryPhone', $request->phone_number_app)->first();

			if(!$user) {

				

				  return response()->json([

					'success' => false,

					'message' => 'User does not exist',

					'data' => '{}'

				], 500);

				

			}



            $otp = rand(1000, 9999);

            $phone = Session::get('phone');

            $phoneAsString = "'".$phone. "'";



            Session::put('otp', $otp);

            Session::put('otp_sent_at', now());



            $msg = "$otp is your OTP to register with iwilltilimwell. For any help please contact us."; 

            $phoneWithCode = "+1".$phone;

            $response = sendSmsViaTextBelt($phoneWithCode, $msg);



            $responseData = json_decode($response, true);

            if (isset($responseData['success']) && $responseData['success']) {

                // Send the response back to the frontend

				

				$user->otp = $otp;

				$user->save();

		

				if(env('TEXT_BELT_MODE')=="active") {

					$otp="0"; 

				}

				

                return response()->json([

                    'success' => true,

                    'message' => 'OTP sent successfully.',

                    'data' => $responseData,

                    'otp' => $otp

                ]);

            }



            // If something went wrong, return an error response

            return response()->json([

                'success' => false,

                'message' => 'Failed to send OTP.',

                'data' => $responseData

            ], 500);

        } catch (\Exception $e) {

            return response()->json([

            'success' => false,

            'message' => $e->getMessage(),

            'data' => '{}'

        ], 500);

        }

    }



    public function validateOtpCode(Request $request) {

        $request->validate([

            'digit1' => 'required|numeric|digits:1',

            'digit2' => 'required|numeric|digits:1',

            'digit3' => 'required|numeric|digits:1',

            'digit4' => 'required|numeric|digits:1',

        ]);



        $code = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4;

        $otp = Session::get('otp');

        $otpSentAt = Session::get('otp_sent_at');

		

		if(Carbon::parse($otpSentAt)->diffInSeconds(now()) > 30) {

			return response()->json([

				'success' => false,

				'message' => 'OTP expired after 30 seconds. Please request a new one.',

				'data' => '{}'

			], 400);

		}

		

		if ((int) $code === $otp) {

            return response()->json([

                'success' => true,

                'message' => 'Matched successfully.',

                'data' => '{}',

            ]);

        } else {

            return response()->json([

                'success' => false,

                'message' => 'You entered wrong otp.',

                'data' => '{}'

            ], 500);    

        }

    }



    public function acceptTermsAndStore(Request $request) {

        $request->validate([

            'terms' => 'required',

        ]);



        $phone = Session::get('phone');

        if ($phone) {

            return response()->json([

                'success' => true,

                'message' => 'Terms accepted successfully.',

                'data' => '{}',

            ]);

        }

        return response()->json([

            'success' => false,

            'message' => 'Please accept terms.',

            'data' => '{}'

        ], 500);    

    }



    public function submitRegisterFinal(Request $request) {

		

		

		

        try {

            $request->validate([

                'fname' => 'required',

                'lname' => 'required',

                'email' => 'required',

                'password' => 'required',

                'address' => 'required'

            ]);



            $input = $request->all();

            $app_agent = Session::get('app_agent');



            $data = User::where('email', '=', $input['email'])->first();

           

            if ($data ) {

                return $this->failResponse([

                    "message" => "The email has already been taken.",

                    "payment_status" => ($data) ? @$data->payment_status : 0,

                    "user_status" => ($data) ? @$data->status : 0,

                    "tele_userid" => ($data) ? @$data->userid : null,

                ], 409);

            } else {



                



                

                $phone = Session::get('phone');

                $phone =  str_replace("+1","",$phone);



                

                $password = $input['password'];

                $user = User::create($input);



                $user->name = $input['fname'] . ' ' . $input['lname'];

                $user->primaryPhone = ($phone) ? $phone : null;

                $user->password = Hash::make($password);

                $user->user_password = base64_encode($password);

                $user->access_site = json_encode(['iwilltilimwell']);

                $user->step_position = 2;

                $user->gender = $input['gender'];

				

				if($app_agent=="IWTIW_Mobile_APP") {

					

					//$user->onboard = "1";

					

				}

                

                $user->save();

				$token = "0";

				if($app_agent=="IWTIW_Mobile_APP") {

					$token = $user->createToken('auth_token')->plainTextToken;

				}

				

				

				UserMeta::create([

						'user_id' => $user->id,

						'prefix'  => 'iwilltilimwell',

						'meta_key'     => 'agent',

						'meta_value'   => $app_agent,

					]);

				

                Session::forget('phone');

                Session::forget('otp');

                Session::forget('actual_phone');

                Session::forget('otp_sent_at');

                

                Auth::login($user);

                return response()->json([

                        'success' => true,

                        'message' => 'Registration success',

                        'token' => $token,

                        'data' => $user

                ]);

                

            }  

        } catch (\Exception $e) {

            return response()->json([

                'success' => false,

                'message' => $e->getMessage(),

                'data' => '{}'

            ], 500);    

        }

    }



    // login with otp setup

    public  function loginWithOtp(Request $request) {

        return view('mobile.auth.login-otp');

    }



    public function loginSendPhoneOtp(Request $request) {

		

		  try {

        $request->validate([

            'phone_number' => 'required|numeric|digits:10',

        ]);



        $phone = $request->phone_number	;

        $countryCode = $request->country;

        $phoneWithCodeAsNum = $phone;

        $phoneWithCode = "'". $phoneWithCodeAsNum ."'";

        // $phone = '9069710000';

        // $phoneWithCode = '+919069710000';



        $data = User::where('primaryPhone', $phoneWithCodeAsNum)->where('user_role', 'user')->first();

        if(!$data) {

            return response()->json([

                'success' => false,

                'message' => 'User does not exist',

                'data' => '{}'

            ]);

        }

        

        if (Session::get('otp') && $request->phone_number == Session::get('actual_phone')) {

            return response()->json([

                'success' => true,

                'message' => 'OTP already sent.',

                'data' => '{}',

                'login_otp' => Session::get('login_otp')

            ]);  

        }



        $otp = rand(1000, 9999);



        // Store OTP and phone number in the session

        Session::put('otp', $otp);

        Session::put('login_phone', $phoneWithCodeAsNum);

        Session::put('login_actual_phone', $phone);

        Session::put('otp_sent_at', now());





        $msg = "$otp is your OTP to register with iwilltilimwell. For any help please contact us."; 

        $phoneWithCode = "+1".$phone;

        $response = sendSmsViaTextBelt($phoneWithCode, $msg);

       

        $responseData = json_decode($response, true);

        if (isset($responseData['success']) && $responseData['success']) {

			

			$data->otp = $otp;

			$data->save();

            

			if(env('TEXT_BELT_MODE')=="active") {

				$otp=""; 

			}

			

			// Send the response back to the frontend

            return response()->json([

                'success' => true,

                'message' => 'Login OTP sent successfully.',

                'data' => $responseData,

                'login_otp' => $otp

            ]);

        }



        // If something went wrong, return an error response

        return response()->json([

            'success' => false,

            'message' => 'Failed to send OTP.',

            'data' => '{}'

        ], 500);

		

		} catch (\Exception $e) {

            return response()->json([

                'success' => false,

                'message' => $e->getMessage(),

                'data' => '{}'

            ], 500);

        }

    }



    public function loginValidateOtpCode(Request $request) {

        try {

            $request->validate([

                'digit1' => 'required|numeric|digits:1',

                'digit2' => 'required|numeric|digits:1',

                'digit3' => 'required|numeric|digits:1',

                'digit4' => 'required|numeric|digits:1',

            ]);



            $code = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4;

            $otp = Session::get('otp');

            $phone = Session::get('login_phone');



            if ((int) $code === $otp) {

                $data = User::where('primaryPhone', '=', $phone)->where('user_role', 'user')->first();

                if ($data) {

                    Session::forget('otp');

                    $loginUserInfo = User::find($data->id);

                    $accessSite = json_decode($data->access_site);

                    if(empty($accessSite) || !in_array('iwilltilimwell',$accessSite)){

                       

                        return response()->json(['success' => false,'message' =>"Login failed with this email you don't have access.",'data' => '{}'], 500);

                    }

                    if($data->status == 0) {

                       

                        return response()->json(['success' => false,'message' => 'Your account is deactivated, please contact support to activate it again.','data' => '{}'], 500);

                    }

                    if($data->payment_status==1) {

                        /*

                        $reg_res = (new ConsultationController)->storeGeneralInfo($data);

                        if(empty($reg_res['success'])){

                            if(str_contains($reg_res['message'], 'Member already exists')) { 

                                $loginUserInfo->update(['payment_status' =>0,'step_position' => 2]);

                            }

                        }

                        */

                    }

                    if($data->expiry_date && $data->expiry_date <  Carbon::now()->toDateString() && false) {

                        $loginUserInfo->update(['payment_status' =>0,'step_position' => 2]);

                    }



                    Auth::login($data);

                    Session::forget('login_phone');

                    Session::forget('otp_sent_at');



                    return response()->json([

                        'success' => true,

                        'message' => 'Matched successfully.',

                        'data' => '{}',

                    ]);

                }

            } else {

                return response()->json([

                    'success' => false,

                    'message' => 'You entered wrong otp.',

                    'data' => '{}'

                ], 500);    

            }

        } catch (\Exception $e) {

            return response()->json([

                'success' => false,

                'message' => $e->getMessage(),

                'data' => '{}'

            ], 500);

        }

    }

	

	

	public function autoLogin(Request $request)

	{	

		$tokenString = $request->query('token');

		if (!$tokenString) {

			return response()->json(['message' => 'Token is required'], 400);

		}



		$accessToken = PersonalAccessToken::findToken($tokenString);

		if (!$accessToken) {

			return response()->json(['message' => 'Invalid or expired token'], 401);

		}

		$user = $accessToken->tokenable;



		Auth::guard('web')->login($user); 



		return redirect('/dashboard');

	}

}


<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;



use App\Http\Controllers\ConsultationController;



use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use App\Interfaces\CommonConstants;

use App\Models\BraintreeTransaction;

use App\Models\Subscription;

use App\Models\User;

use Config;

use Session;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

use App\Mail\OrderPurchasedMail;

use Illuminate\Support\Facades\Mail;





class LoginController extends Controller implements CommonConstants

{

    /*

    |--------------------------------------------------------------------------

    | Login Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles authenticating users for the application and

    | redirecting them to your home screen. The controller uses a trait

    | to conveniently provide its functionality to your applications.

    |

    */



    use AuthenticatesUsers;



    /**

     * Where to redirect users after login.

     *

     * @var string

     */

    protected $redirectTo = RouteServiceProvider::INFO;



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('guest')->except('logout');

    }



    // override the actual login page

    public function showLoginForm()

    {

		/* $user = Auth::user();

		$order['user_name']=$user->fname??'John';

		$order['packag_name']=$planDetails->name??'Basic';

		$order['package_price']=$planDetails->amount??'100';

		$order['optional_amount']=$optional_amount??'10';

		$order['package_purchase_date'] = Carbon::now()->format('F j, Y');

		$order['package_purchase_time'] = Carbon::now()->format('g:i A');

		$order['subscription_start_date'] = Carbon::now()->format('m/d/Y');

		$order['subscription_end_date']   = Carbon::now()->format('m/d/Y');

		Mail::to("teqdeft@gmail.com")->send(new OrderPurchasedMail($order));  */	

		

        if (isMobile()) {

            return view('mobile.auth.login');    

        }

        return view('auth.login');

    }



    /**

     * The user has been authenticated.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  mixed  $user

     * @return mixed

     */

    protected function authenticated(Request $request, $user)

    {

        $input = $request->all();

		

        if ($user->user_role==self::ADMIN || $user->user_role==self::OTHERS ) {

            return redirect('/admin/dashboard')->with('success', 'Login Successfully');

        }else if ($user->user_role==self::AFFILIATE) {

            return redirect('/affiliate/dashboard')->with('success', 'Login Successfully');

        } else if ($user->user_role==self::COUNSELLOR) {

            return redirect('/counsellor/dashboard')->with('success', 'Login Successfully');

        } else {



        die("Here");

			

            if ($user->status == 0) {

                $message = 'Your account is deactivated, please contact support to activate it again.';

                $this->logout($request);

                return redirect()->back()

                    ->withInput()

                    ->withErrors([

                        $this->username() => $message,

                    ]);

            } else if ($user->expiry_date && $user->expiry_date <  Carbon::now()->toDateString() && false) {

				

				

                $message = 'Your payment expire please subscribe';

                $this->logout($request);

                return redirect()->back()

                    ->withInput()

                    ->withErrors([

                        $this->username() => $message,

                    ]);

            } else {

                

                $accessSite = json_decode($user->access_site);

                if( empty($accessSite) || !in_array('iwilltilimwell',$accessSite) ){

                    $this->logout($request);

                        return redirect()->back()

                            ->withInput()

                            ->withErrors([

                                // This is where we are providing the error message.

                                $this->username() => "Login failed with this email you don't have access",

                            ]);

                }

                if (($user->step_position==2 || $user->step_position== 3 || $user->step_position == 4 ) && $user->payment_status==0) {

					

                    $result = (new ConsultationController)->validateEmail($user->email);

                    $request->session()->flash('success', 'Login Successfully');

					return redirect('dashboard');

                } else {

                    // Check if user exists in My Telemedicine

                    $result = (new ConsultationController)->validateEmail($user->email);

					

					if (isset($result['success'], $result['availableForUse']) && $result['availableForUse']) {

                    /*

					if(isset($result['success']) && $result['availableForUse']){

					*/ 	

                        // Kindly Regiseter the user If Not Registerd Previously in My Telemedicine

                        $reg_res = (new ConsultationController)->storeGeneralInfo($user);

                        if(isset($reg_res['success']) && $reg_res['success'] ){

                            // user registered

                             $response = (new ConsultationController())->setMemberSession($user);

                            if (isset($response['success'])) {

                                $request->session()->flash('success', 'Login Successfully');

                            } else {

                                // Log the user out.

                                $this->logout($request);

                                return redirect()->back()

                                    ->withInput()

                                    ->withErrors([

                                        $this->username() => "Login failed with this email please contact with support",

                                    ]);

                            }

                        }else{

                            // Member Already Exists

                            

                            if (str_contains($reg_res['message'], 'Member already exists')) { 

                               

                                $today = Carbon::now()->toDateString();

								$activeSubscriptions = DB::table('braintree_subscription')

														->where('user_id',$user->id)

														->whereDate('subscription_start_date', '<=', $today)

														->whereDate('subscription_end_date', '>=', $today)

														->where('subscription_status','active')

														->count();

													

								if($activeSubscriptions) { 

								

									$request->session()->flash('success', 'Login Successfully');

									return redirect('dashboard');

								} else  {

								

									$userInfo = User::find($user->id);

								    $userInfo->update(['payment_status' =>0,'step_position' => 2]);

								    return redirect('dashboard'); 



								}	



                                





                            } else {

                                $request->session()->flash('success', 'Login Successfully');

                            }

                            

                        }

                        

                    } else{

						

						/*  */

                        $response = (new ConsultationController())->setMemberSession($user);

					

                        if (isset($response['success'])) {

                            $request->session()->flash('success', 'Login Successfully');

                        } else {

                            // Log the user out.

                            $this->logout($request);

							return back()->withErrors(['error_email_password' => 'Invalid email or password']);



                            /* return redirect()->back()

                                ->withInput()

                                ->withErrors([

                                    'error_email_password' => $result['message']??'Invalid Login Info',

                                ]); */

                        }

                        

                    }

                   

                }

                activityLog('Login our account');



               /*  if(isMobile()) {

                    

                    if($user['onboard']){

                        return redirect('mobile-dashboard');

                    }

                    return redirect('mobile-onboard');

                } */

            }

        }

    }

	

	public function customLogin(Request $request) {

		

		$user = User::where('email', $request['email'])->first();

        if($user && Hash::check($request['password'], $user->password)) {

			

			/* echo "<pre>";

			print_r($user);

			echo "</pre>";

			die("Here"); */

			Auth::login($user);

			if($user->user_role==self::ADMIN || $user->user_role==self::OTHERS ) {

				return redirect('/admin/dashboard')->with('success', 'Login Successfully');

			}else if ($user->user_role==self::AFFILIATE) {

				return redirect('/group-organizations')->with('success', 'Login Successfully');

				//return redirect('/affiliate/dashboard')->with('success', 'Login Successfully');

			} else if ($user->user_role==self::COUNSELLOR) {

				return redirect('/counsellor/dashboard')->with('success', 'Login Successfully');

			} else if ($user->user_role==self::GROUP_ORGANIZATION) {

				return redirect('/group-organizations')->with('success', 'Login Successfully');

			}

			

			if($user->parentId) {

				

				$activeSubscriptionsParent = getBrainTreeSubscriptionActive($user->parentId);

				if(empty($activeSubscriptionsParent)) {

					$user->update(['payment_status' =>0,'step_position' => 2]);

				}

				

			} else  {

				

				if($user->expiry_date && $user->expiry_date <  Carbon::now()->toDateString() && false) {

					$user->update(['payment_status' =>0,'step_position' => 2]);

				}

				$activeSubscriptions = getBrainTreeSubscriptionActive($user->id);

				if(empty($activeSubscriptions)) {

					$user->update(['payment_status' =>0,'step_position' => 2]);

				}

			}

			

			if($user->payment_status==1) {

				$reg_res = (new ConsultationController)->storeGeneralInfo($user);
                if (!empty($reg_res) && is_array($reg_res)) {
                        if(str_contains($reg_res['message'], 'Member already exists')) {

                            $response = (new ConsultationController())->setMemberSession($user);

                        } else if(isset($reg_res['success']) && $reg_res['success']){

                            $response = (new ConsultationController())->setMemberSession($user);

                        }
                }

			}

			if(isMobile()) {

                if($user['onboard']){

                    return redirect('mobile-dashboard');

                }

                return redirect('mobile-onboard');

            }

			return redirect('/dashboard')->with('success', 'Login Successfully');

        }



        return redirect()->back()->with('error', 'Invalid credentials.');

		

	}

	

    public function logout(Request $request) {

        //activityLog('Logout our account');

        $this->guard()->logout();



        $request->session()->invalidate();



        return redirect('/');

    }

	

	





}


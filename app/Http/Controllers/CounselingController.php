<?php

namespace App\Http\Controllers;

use Braintree;
use App\Models\User;
use App\Models\PageContents;
use Illuminate\Http\Request;
use App\Mail\CreateHostLinkMail;
use App\Mail\CounselingRefundMail;
use App\Models\BraintreeTransaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateHostRemainderMail;
use App\Models\GroupCounseling as GP;
use Illuminate\Support\Facades\Session;
use App\Models\GroupCounselingTime as GCT;
use App\Models\BraintreeTransactionRefund as BTR;

class CounselingController extends Controller
{
    /**
     * Show the Counseling.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('counseling/index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        // $this->middleware('auth');
    }

    /**
     * Show the teleCounseling.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function counseling()
    {
        return view('counseling/counseling');
    }

    /**
     * Show the teleCounseling.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function teleCounseling()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '10')->whereNull('parent_id')->get();
        $formatedData = [];
        foreach ($pageContents as $eachRow) {
            $formatedData[$eachRow->section_name] = [];
            $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
            $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
            $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
            $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
            $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
        }
        if(isMobile()) {
            return view('mobile/counseling/tele-counseling', compact('formatedData'));
        }
        return view('counseling/tele-counseling', compact('formatedData'));

        // return view('counseling/tele-counseling');
    }

    /**
     * Show the Group Counseling.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function setTimeZone(Request $request){
        $postData = $request->all();
        Session::put('user_time_zone',$postData['DefineUserTimeZone']);
    }
    
    public function groupCounseling()
    {   
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '12')->whereNull('parent_id')->get();
        $allCounseling = GP::with("timeTable")->get();
        $counselorData = [];
        $userTimeZone = ( !empty(Session::get('user_time_zone')) )
                        ?Session::get('user_time_zone'):'America/Los_Angeles'; 

        if ($allCounseling) {

            foreach ($allCounseling as $key => $value) {
                foreach ($value->timeTable as $timeKey => $timeValue) {
                    if ($timeValue->date >= date('Y-m-d') /* && $value['last_registration_date'] <= date('Y-m-d') */ ) {
                        $barColor = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
                        $barBackColor = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
                        $date = $start = date('Y-m-d', strtotime("{$timeValue->date}"));
                        $start = date('H:i:s', strtotime("{$timeValue->startTime}"));
                        $end = date('H:i:s', strtotime(" {$timeValue->endTime}"));
                        $HoursStart = date('h:i A',strtotime(converToTz(date("h:i:s", strtotime("{$start}")),$userTimeZone,$timeValue->time_zone )));
                        $HoursEnd   = date('h:i A',strtotime(converToTz(date("h:i:s", strtotime("{$end}")),$userTimeZone,$timeValue->time_zone )));
                        $counselorData[] = [
                            'start' => converToTz(date("Y-m-d H:i:s", strtotime("{$date} {$start}")),$userTimeZone,$timeValue->time_zone ),
                            'end' => converToTz(date("Y-m-d H:i:s", strtotime("{$date} {$end}")),$userTimeZone,$timeValue->time_zone ),
                            'id' => $value->id, 'text' => "Title : {$value->title}, Date :{$date}, {$HoursStart} To {$HoursEnd}",
                            'barColor' => $barColor, 'barBackColor' => $barBackColor,'time_zone' => $timeValue->time_zone
                        ];
                    }
                }
            }
        }

        $formatedData = [];
        foreach ($pageContents as $eachRow) {
            $formatedData[$eachRow->section_name] = [];
            $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
            $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
            $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
            $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
            $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
        }
        $environment = env('BTREE_ENVIRONMENT');
        $gateway = new Braintree\Gateway([
            'environment' => $environment,
            'merchantId' => env('BTREE_MERCHANT_ID'),
            'publicKey' => env('BTREE_PUBLIC_KEY'),
            'privateKey' => env('BTREE_PRIVATE_KEY')
        ]);
        $clientToken = $gateway->clientToken()->generate();

        return view('counseling/group-counseling', compact('formatedData', 'allCounseling', 'clientToken', 'counselorData'));
        // return view('counseling/group-counseling');
    }

    public function generateRandomKey()
    {
        $length = 10;
        $key = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
        $transaction = BraintreeTransaction::where("token", "=", $key)->first();
        if (!($transaction)) {
            return $key;
        } else {
            $this->generateRandomKey();
        }
    }

    public function subscribeToCounseling(Request $request)
    {
        try {
            $input = $request->all();
            try {
                $environment = env('BTREE_ENVIRONMENT');
                $gateway = new Braintree\Gateway([
                    'environment' => $environment,
                    'merchantId' => env('BTREE_MERCHANT_ID'),
                    'publicKey' => env('BTREE_PUBLIC_KEY'),
                    'privateKey' => env('BTREE_PRIVATE_KEY')
                ]);

                if ($input['select_counseling']) {
                    $select_counseling = explode('__', $input['select_counseling']);
                    $input['select_counseling'] = $select_counseling[1];
                }


                $nonceFromTheClient = $input["payment_method_nonce"];
                $user = User::where('email', "=", $input['email'])->first();
                $counseling = GP::where("id", "=", $input['select_counseling'])->first();
                //prePrint($counseling->registration_fee);
                // dd();
                if (!($user)) {
                    $user = new User();
                    $user->fname = $input['first_name'];
                    $user->lname = $input['last_name'];
                    $user->email = $input['email'];
                    $user->primaryPhone = $input['phone_number'];
                    $user->save();
                }
                if ($user->braintree_customer_id) {
                    $customer_id = $user->braintree_customer_id;
                } else {
                    $result = $gateway->customer()->create([
                        'id' => $user->id,
                        'firstName' => $user->fname,
                        'lastName' => $user->lname,
                        'email' => $user->email
                    ]);
                    if ($result->success) {
                        $customer_id = $result->customer->id;
                    }
                }
                $user->braintree_customer_id = $customer_id;
                $user->save();
                $final_amount = $counseling->registration_fee;
                $braintree_amount = $counseling->registration_fee;
                $payment_result = $gateway->transaction()->sale([
                    'amount' => $braintree_amount,
                    'customerId' => $customer_id,
                    'paymentMethodNonce' => $nonceFromTheClient,
                    'options' => [
                        'submitForSettlement' => True
                    ]
                ]);

                if (!$payment_result->success) {
                    $request->session()->flash("error", "Please check your card details it doesn't seems to be valid");
                    return redirect("/group-counseling");
                }

                // save braintree transactions //
                $transaction = new BraintreeTransaction();
                $transaction->user_id = $user->id;
                $transaction->amount = $final_amount;
                $transaction->counseling_id = $input['select_counseling'];
                $transaction->status = $payment_result->transaction->status;
                $transaction->transaction_id = $payment_result->transaction->id;
                $transaction->final_amount = $final_amount;
                $transaction->promo_code_id = $user->promo_code_id;
                $transaction->token = $this->generateRandomKey();
                $transaction->transaction_type = 'counseling';
                if ($transaction->save()) {
                    $counselingGP = new GP();
                    $counseling = $counselingGP::find($input['select_counseling']);
                    $link = url("/host-group-counseling/") . "/{$transaction->token}";
                    $data = [
                        'email' => $input['email'],
                        'name' => "{$input['first_name']} {$input['last_name']}",
                        'link' => $link
                    ];
                    $timing = [];
                    if (isset($counseling->timeTable) && !empty($counseling->timeTable)) {
                        foreach ($counseling->timeTable as $key => $value) {
                            $timing['counselingTime'][] = [
                                'start' => "{$value->date} {$value->startTime}",
                                'end' => "{$value->date} {$value->endTime}"
                            ];
                        }
                        if (!empty($timing)) {
                            $data = $data + $timing;
                        }
                    }
                    Mail::to($input['email'])->send(new CreateHostLinkMail($data));
                }
                $request->session()->flash('message', 'You are successfully subscribed.');
                return redirect("/group-counseling");
            } catch (\Exception $e) {
                dd($e->getMessage());
                return back()->withErrors(['message' => 'Error creating subscription. ' . $e->getMessage()]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function hostGroupCounseling(Request $request)
    {
        $transaction = BraintreeTransaction::where("token", "=", request()->segment(2))->first();



        if (!$transaction) {
            return abort(404);
        }

        $formatedData = [];
        $counseling = GP::where("id", "=", $transaction->counseling_id)->first();
        // dd($counseling);



        if (!$counseling) {
            return abort(404);
        }
        $user = User::where("id", "=", $transaction->user_id)->first();
        if (!$user) {
            return abort(404);
        }

        $host_tran =  BraintreeTransaction::where("counseling_id", "=",  $counseling->id)->where("status", "=", "payment_for_host")->first();
        $host_user = User::where("id", "=", $host_tran->user_id)->first();



        // dd($host_tran);
        if (isset($counseling->timeTable)) {
            $currentData = date('Y-m-d H:i');
            $linkStatus = false;
            $expireMsg = $hostMsg = [];
            foreach ($counseling->timeTable as $key => $value) {
                $startTime      = date('H:i', strtotime("{$value->startTime}"));
                $endTime        = date('H:i', strtotime("{$value->endTime}"));
                $startDateBy     =  date('Y-m-d H:i', strtotime("{$value->date} {$value->startTime}"));
                $endDateBy       =  date('Y-m-d H:i', strtotime("{$value->date} {$value->endTime}"));

                if ($startDateBy <= date('Y-m-d H:i') && $endDateBy >= date('Y-m-d H:i')) {
                    $expireMsg = ['linkStatus' => false];
                    goto end;
                } else {
                    if ($startDateBy > date('Y-m-d H:i')) {
                        $hostMsg[] = ['status' => 'before', 'timer' => date('Y-m-d H:i', strtotime($startDateBy)), 'linkStatus' => true];
                    } elseif ($startDateBy < date('Y-m-d H:i')) {
                        $hostMsg[] = ['status' => 'after', 'timer' => $endTime, 'linkStatus' => true];
                        $expireMsg = ['status' => 'after', 'timer' => $endTime, 'linkStatus' => true];
                    } elseif ($startDateBy == date('Y-m-d H:i')) {
                        if ($startTime <= date('H:i') && $endTime >= date('H:i')) {
                            $hostMsg[] = ['linkStatus' => false];
                        } else {
                            $hostMsg[] = ['status' => 'before', 'timer' => date('Y-m-d H:i', strtotime($startDateBy)), 'linkStatus' => true];
                        }
                    }
                }
            }


            if ($hostMsg) {
                foreach ($hostMsg as $key => $value) {
                    if ($value['status'] == 'before') {
                        $expireMsg = $value;
                        goto goend;
                    }
                }
            }
            goend:
            end:
            if ($expireMsg['linkStatus']) {
                return view('counseling/host-counseling-status', compact('expireMsg'));
            }
        }
        $noHeader = true;
        $noFooter = true;

        $isHost = $user->user_role == 'counsellor' ? true : false;
        $host_email = $host_user->email;
        $host_identity = $host_user->fname . ' ' . $host_user->lname;
        $user_email = $user->email;
        return view('counseling/host-group-counseling', compact('counseling', 'noHeader', 'noFooter', 'user', 'isHost', 'host_email', 'user_email', 'host_identity'));
    }

    public function counselingRemainderMail()
    {
        $previewsTwoDay = date('Y-m-d', strtotime("+2 days"));
        $previewsOneDay = date('Y-m-d', strtotime("+1 days"));
        $currentDay     = date('Y-m-d');
        
        $counselingTime = new GCT();
        $counselingTwodaysUser = $counselingTime->hostLinkRemainder([
            'twoDay' => $previewsTwoDay, 'oneDay' => $previewsOneDay,
            'currentDay' => $currentDay
        ]);
        if (!$counselingTwodaysUser->isEmpty()) {
            $data = [];
            $email = [];
            foreach ($counselingTwodaysUser as $key => $value) {
                $hourdiff = round((strtotime("{$value->date} {$value->startTime}") - strtotime(date('Y-m-d H:i'))) / 3600, 1);
                $details = [
                    'name' => $value->name, 'start' => date('Y F d h:i A', strtotime("{$value->date} {$value->startTime}")),
                    'end'  => date('Y F d h:i A', strtotime("{$value->date} {$value->endTime}")),
                    'link' => url("host-group-counseling/{$value->token}")
                ];
                if ($hourdiff <= 48 && $hourdiff > 47 ) {
                    $data[$value->GPid . '_' . $value->usersId] =  $details + [
                        'msg' => "Two days left for {$value->title} counseling. ",
                        'email' => $value->email
                    ];
                } elseif ($hourdiff <= 24 && $hourdiff >= 23) {
                    $data[$value->GPid . '_' . $value->usersId] =  $details + ['msg' => "One days left for {$value->title} counseling. ", 'email' => $value->email];
                } elseif ($hourdiff <= 2 && $hourdiff >= 1) {
                    $data[$value->GPid . '_' . $value->usersId] =  $details + ['msg' => "Two hous left for {$value->title} counseling. ", 'email' => $value->email];
                }
            }

            if (!empty($data)) {
                foreach ($data as $key => $value) {
                    Mail::to($value['email'])->send(new CreateHostRemainderMail($value));
                }
            }
        }
    }

    public function counselingRefundPayment(){
        $gateway = new Braintree\Gateway([
            'environment' => env('BTREE_ENVIRONMENT'),
            'merchantId' => env('BTREE_MERCHANT_ID'),
            'publicKey' => env('BTREE_PUBLIC_KEY'),
            'privateKey' => env('BTREE_PRIVATE_KEY')
        ]);

        //$data = $gateway->transaction()->refund('75dy29n7');

        $GCT = new GCT();
        $GCTData = $GCT->getPerviousDateList();
        $dataInsert = $getCancelCounseling = [];
        if(!$GCTData->isEmpty()){
            foreach($GCTData as $key => $value){
                $hourdiff = round((strtotime("{$value->date} {$value->startTime}") - strtotime(date('Y-m-d H:i'))) / 3600, 1);
                if( $hourdiff <= 24 && $hourdiff > 23 ){
                    $getCancelCounseling[$value->group_counseling_id]['minimum_users'] = $value->minimum_number_of_users;
                    $getCancelCounseling[$value->group_counseling_id][$value->user_role][] = $value->toArray();
                }
            }
            if( !empty($getCancelCounseling) ){
                foreach($getCancelCounseling as $key => $value){
                    $totalUsers = count($value['user']);
                    if( $totalUsers < $value['minimum_users'] ){
                        foreach($value['user'] as $userKey => $userValue){
                            $refund = $gateway->transaction()->refund($userValue['transaction_id']);
                            $dataInsert[] = ['transaction_id' => $userValue['transaction_id'],'type' => 'refund',
                            'reason' => 'Member not fullfill according to counseling'];
                            $emailData[] = ['email' => $userValue['email'],'amount' => $refund->transaction->amount,'name' => $userValue['name'],
                                            'msg' => 'Member not fullfill according to counseling','start' => "{$userValue['date']} {$userValue['startTime']}",
                                            'end' => "{$userValue['date']} {$userValue['endTime']}",'title' => $userValue['title'] ];
                        }
                    }
                }
                if( $dataInsert ){
                     BTR::insert($dataInsert);
                    if( $emailData ){
                        foreach($emailData as $key => $value){
                            Mail::to($value['email'])->send(new CounselingRefundMail($value));
                        }
                    }
                }
            }
        }
    }


}

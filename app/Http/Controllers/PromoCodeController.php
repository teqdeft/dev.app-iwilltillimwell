<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Promocode;
use App\Models\User;
use App\Mail\PromoCodeMail;
use Stripe\StripeClient;
use Validator;
use App\Validators\PromoCodeValidator;
use App\Models\CommissionTransaction;

class PromoCodeController extends Controller
{
    public function index(Request $request){
        try{
            $promo = Promocode::orderBy('id', 'DESC')->get();
            if ($request->wantsJson() || $request->ajax()) {
                $jsonCollection = collect();
                $promo->each(function ($item, $key) use ($jsonCollection) {
                    $user = User::where('id',$item->influencer_id)->first();
                    $influencer_payable_amount = 0;
                    if (CommissionTransaction::where(array('influencer_id'=>$item->influencer_id,'status'=>'0'))->exists()) {
                        $influencer_payable_amount = CommissionTransaction::where(array('influencer_id'=>$item->influencer_id,'status'=>'0'))->sum('influencer_payable_amount');
                    }
                    $jsonCollection->push([
                        'sr_no' => $key+1,
                        'id' => $item->id,
                        'code' => $item->code,
                        'members_discount_amount' => ( isset($item->member_discount_type) && $item->member_discount_type == 'percentage')?round($item->member_discount_amount,2).'%':'$'.round($item->member_discount_amount,2),
                        'inc_name' => $user->name??'N/A',
                        'influencer_discount_amount' => ( isset($item->influencer_commission_type) && $item->influencer_commission_type == 'percentage')?round($item->influencer_commission_amount,2).'%':'$'.round($item->influencer_commission_amount,2),
                        'influencer_payable_amount' => $influencer_payable_amount ? '$'. round($influencer_payable_amount, 2) : "N/A",
                        'allowed_members' => $item->allowed_members??'N/A',
                        'status' => $item->status??'N/A',
                    ]);
                });

                return response()->json(['data' => $jsonCollection]);
            }

            return view('admin.promo-code.index',compact('promo'));
        }catch (\Exception $e) {
            echo json_encode(["message" => $e->getMessage() ]);
        }
    }
    public function create() {
        $users = $promo = [];
        return view('admin.promo-code.create',compact('promo','users'));
    }

    public function edit($id){
        $promo = Promocode::find($id);
        if( $promo->influencer_type == 2 ){
            $users = Promocode::getAllInfluencerWithOrg();
        }else{
            $users = Promocode::getAllInfluencer();
        }
        return view('admin.promo-code.create',compact('promo','users'));
    }

    public function store(Request $request) {
        $promoCodeValidator = new PromoCodeValidator();
        try {
            $input = $request->all();
            if (!$promoCodeValidator->with($input)->passes()) {
                $request->session()->flash('error', $promoCodeValidator->getErrors()[0]);
                return back()
                    ->withErrors($promoCodeValidator->getValidator())
                    ->withInput();
            }

            $to = \Carbon\Carbon::createFromFormat('Y-m-d',$input['valid_from']);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d',$input['valid_to']);
            $diff_in_months = $to->diffInMonths($from);
            $data = array(
                'code' => $input['code'],
                'valid_from' => date('Y-m-d',strtotime($input['valid_from'])),
                'valid_to' => date('Y-m-d',strtotime($input['valid_to'])),
                'influencer_id' => $input['influencer_id'],
                'influencer_commission_type' => $input['influencer_commission_type'],
                'influencer_commission_amount' => $input['influencer_commission_amount'],
                'allowed_members' => $input['allowed_members'],
                'member_discount_type' => $input['member_discount_type'],
                'member_discount_amount' => $input['member_discount_amount'],
                'influencer_type' => $input['influencerType'],				                'coupon_mode' => $input['coupon_mode']
            );
            if( $input['influencerType'] == 2 ){
                if (!empty($input['commission_from']) && !empty($input['commission_to'])) {
                    $data['commission_from'] = date('Y-m-d',strtotime($input['commission_from']));
                    $data['commission_to'] = date('Y-m-d',strtotime($input['commission_to']));
                }
            }else{
                $data['commission_from'] = null;
                $data['commission_to'] = null;
            }

            if( !empty($input['id']) ){
                $store = Promocode::where('id',$input['id'])->update($data);
                $flashMsg = 'Promo code updated successfully.';
            }else{
                $store = Promocode::create($data);
                $flashMsg = 'Promo code added successfully.';
            }
            $user = User::where('id',$input['influencer_id'])->first();

            if($store && $user) {
                $data['influencer_name'] = $user->name;
                $mail = Mail::to($user->email)->send(new PromoCodeMail($data));
                $request->session()->flash('success', $flashMsg);
                return redirect('/admin/promo-codes');
            } else {
                return redirect()->back()->with('success', 'Error please try again Code is not generated');
            }
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }
    public function delete($id){
        Promocode::where('id', $id)->delete();
        return redirect()->route('index');
    }
    public function show($id){
        $codes = Promocode::where('id',$id)->first();
        $user = User::where('id',$codes->influencer_id)->first();
        return view('admin.promo-code.show', compact('codes','user'));

    }
    public function payment_status($id, $status)
    {
       $update_status = CommissionTransaction::where('influencer_id',$id)->update(['status' => $status]);
       if ($update_status) {
            return redirect()->back()->with('success', 'Affiliate amount paid successfully');
       } else {
            return redirect()->back()->with('success', 'Error please try again');
       }
    }

}

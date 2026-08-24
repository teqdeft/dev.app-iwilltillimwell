<?php

namespace App\Http\Controllers\GroupOrganizations;
use auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payout;
use Illuminate\Support\Facades\Validator;


class WithdrawalController extends Controller
{
    
	public function index() {
		
		$title = "Dashboard";
		
		$withdrawals = Payout::where('user_id', auth()->id())
						->orderByDesc('id')
						->paginate(10);
		if(ismobile()) {
			return view("mobile.group-organizations.withdrawal.list",compact('withdrawals'));
		}
		return view("group-organizations.withdrawal.list",compact('withdrawals'));
		
	}
	public function addwithdrawalForm() {
		
		$title = "Dashboard";
		if(ismobile()) {
			return view("mobile.group-organizations.withdrawal.add",compact('title'));
		}
		return view("group-organizations.withdrawal.add",compact('title'));
		
	}
	
	public function store(Request $request)
    {
        $validator = Validator::make(
		$request->all(),
			['total_withdrawal' => 'required|numeric|min:1'],
			['total_withdrawal.required' => 'Please enter valid withdrawal amount']
		);

	if ($validator->fails()) {
		return back()
			->withErrors($validator)
			->withInput()
			->with('error', 'Please enter valid withdrawal amount');
	}

        $user = Auth::user();
		$data = getInfluenceWallet(auth()->user()->id);
        // Get available balance (example logic – adjust to your system)
        $availableBalance = $data['total_balance']; 

        if ($request->total_withdrawal > $availableBalance) {
			
			return back()->with('error', 'Withdrawal amount exceeds available balance.');
			
   
        }

        Payout::create([
            'user_id'          => $user->id,
            'total_withdrawal' => $request->total_withdrawal,
            'grand_withdrawal' => $request->total_withdrawal,
            'paid_payout' 	   => $request->total_withdrawal,
            'status'           => 'pending',
        ]);

        // Optional: deduct balance
       // $user->wallet_balance -= $request->total_withdrawal;
        //$user->save();

        return redirect()
			->route('group-organizations-withdrawal-list')
			->with('success', 'Withdrawal request submitted successfully.');

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payout;
use Illuminate\Support\Facades\Validator;



class PayoutController extends Controller
{
    
	public function index(Request $request) {
		
		$title = "Index";
		$status = request()->query('status', 'all');
		$payouts = Payout::join('users', 'users.id', '=', 'payouts.user_id')
					  ->when($status !== 'all', function($query) use ($status) {
							$query->where('payouts.status', $status);
						})
						->select('payouts.id','payouts.total_withdrawal','payouts.paid_payout','payouts.remark','payouts.status','payouts.created_at','users.fname','users.lname')
						->orderByDesc('payouts.id')
						->paginate(10);
			
			
		return view('admin.payout.index', compact('payouts'));
		
	}
	
	public function payoutUpdateStatus(Request $request) {
		
		 $validator = Validator::make($request->all(), [
			'payout_id' => 'required|exists:payouts,id',
			'status'    => 'required|in:approved,pending,rejected',
			'remark'    => 'nullable|string'
		]);

		
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'message' => 'Validation error',
				'errors'  => $validator->errors()
			], 422);
		}
	

		$payout = Payout::find($request->payout_id);
		if(!$payout) {
			return response()->json([
				'success' => false,
				'message' => 'Invalid Payout ID'
			], 422);
			
		}
		$payout->update([
			'status' => $request->status,
			'paid_payout' => $request->paid_payout??'0',
			'remark' => $request->remark,
		]);

		return response()->json([
			'success' => true,
			'message' => 'Payout updated successfully'
		]);
		
	}
	
}

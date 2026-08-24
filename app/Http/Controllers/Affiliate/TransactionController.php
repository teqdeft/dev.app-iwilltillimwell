<?php

namespace App\Http\Controllers\Affiliate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommissionTransaction;



class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
     try{

            $user = $request->user();
            $transactions = CommissionTransaction::where(['influencer_id' => $user->id])->get();
            if ($request->wantsJson() || $request->ajax()) {
                $jsonCollection = collect();
                $transactions->each(function ($item, $key) use ($jsonCollection) {
                    $jsonCollection->push([
                        'sr_no' => $key+1,
                        'code' => $item->promocode->code,
                        'name' => $item->member->name,
                        'members_discount_amount' => $item->commission_amount,
                        'status' => $item->custom_status,
                    ]);
                });
                return response()->json(['data' => $jsonCollection]);
            }

            return view('affiliate.transaction-history.index', compact('transactions'));
        }catch (\Exception $e) {
            echo json_encode($this->failResponse([
                "message" => $e->getMessage(),
            ], 500));

        }
    }
}

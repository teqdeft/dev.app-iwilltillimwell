<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PlanType;
use App\Validators\PlansValidator;

use App\Interfaces\CommonConstants;


class PlanController extends Controller implements CommonConstants
{
    public function index(Request $request) {
        try {
            $plans = Plan::all();
            if ($request->wantsJson() || $request->ajax()) {
                $jsonCollection = collect();
                $plans->each(function ($item, $key) use ($jsonCollection) {
                    $jsonCollection->push([
                        'sr_no' => $key+1,
                        'id' => $item->id,
                        'name' => $item->name,
                        'amount' => $item->amount_with_currency,
                        'interval' => $item->interval,
                        'type' => $item->type,
                    ]);
                });
                return response()->json(['data' => $jsonCollection]);
            }
            return view('admin.plans.index',compact('plans'));
        } catch (\Exception $e) {
            echo json_encode($this->failResponse([
                "message" => $e->getMessage(),
            ], 500));
            die;
        }
    }
    public function create() {
        $type = PlanType::where('status',1)->get()->toArray();
        /* $options = $types_create->pluck('name', 'value'); */
        $intervals_create = collect([
            ['name' => 'Select interval', 'value' => ''],
            ['name' => 'Monthly', 'value' => 'monthly'],
            ['name' => 'Quarterly', 'value' => 'Quarterly'],
            /* ['name' => 'semiannual', 'value' => 'Semiannual'],
            ['name' => 'yearly', 'value' => 'Yearly'], */
        ]);
        $member_create = collect([
            ['name' => 'Select type','value' => ''],
            ['name' => 'Self','value' => 1],
            ['name' => 'Self + Family','value' => 2],
        ]);

        $interval_opt = $intervals_create->pluck('name', 'value');
        $member_opt = $member_create->pluck('name', 'value');
        return view('admin.plans.create', compact('interval_opt','type','member_opt'));
    }
    public function store(Request $request) {
        $plansValidator = new PlansValidator();
        try {
            $input = $request->all();

            if (!$plansValidator->with($input)->passes()) {
                $request->session()->flash('error', $plansValidator->getErrors()[0]);
                return back()
                    ->withErrors($plansValidator->getValidator())
                    ->withInput();
            }
                $data = array(
                    'type' => $input['type'],
                    'name' => $input['name'],
                    'plan_type' => $input['plan_type'],
                    'member_type' => $input['member_type'],
                    'interval' => $input['interval'],
                    'amount' => $input['amount'],
                    'description' => htmlentities($_POST['description']),
                );
             Plan::create($data);
            $request->session()->flash('success', 'Plan added successfully.');
            return redirect('/admin/plans');

        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }
    public function delete(Request $request, $id){
        Plan::where('id', $id)->delete();
        $request->session()->flash('success', 'Plan deleted successfully.');
        return redirect('/admin/plans');
    }
    public function edit($id)
    {
        $data = Plan::where('id', $id)->first();
        $type = PlanType::where('status',1)->get()->toArray();

        $intervals_create = collect([
            ['name' => 'Monthly', 'value' => 'monthly'],
            ['name' => 'Quarterly', 'value' => 'Quarterly'],
        ]);

        $member_create = collect([
            ['name' => 'Select type','value' => ''],
            ['name' => 'Self','value' => 1],
            ['name' => 'Self + Family','value' => 2],
        ]);

        $interval_opt = $intervals_create->pluck('name', 'value');
        $member_opt = $member_create->pluck('name', 'value');
        return view('admin.plans.edit', compact('data', 'interval_opt','type','member_opt'));
    }

    public function update(Request $request)
    {
        $id= $request->id;
        $plansValidator = new PlansValidator();
        try {
            $input = $request->all();

            if (!$plansValidator->with($input)->passes()) {
                $request->session()->flash('error', $plansValidator->getErrors()[0]);
                return back()
                    ->withErrors($plansValidator->getValidator())
                    ->withInput();
            }
            $data = array(
                'type' => $input['type'],
                'name' => $input['name'],
                'interval' => $input['interval'],
                'amount' => $input['amount'],
                'plan_type' => $input['plan_type'],
                'member_type' => $input['member_type'],
                'description' => htmlentities($_POST['description']),

            );
            $plan_data = new Plan;
            $plan_data->where('id', $id)->update($data);
            $request->session()->flash('success', 'Plan Updated successfully.');
            return redirect('/admin/plans');
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }
}

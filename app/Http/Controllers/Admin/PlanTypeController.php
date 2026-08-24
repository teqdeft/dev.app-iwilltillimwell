<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanType;
use App\Validators\PlanTypesValidator;
use Illuminate\Http\Request;
use Session;

class PlanTypeController extends Controller
{   

    public function index(Request $request)
    {   
        $planType = PlanType::all()->sortByDesc("id");
        if ($request->wantsJson() || $request->ajax()) {
          $jsonCollection = collect();
          $planType->each(function ($item, $key) use ($jsonCollection) {
                $jsonCollection->push([
                    'sr_no' => $key+1,
                    'id'    => $item->id,
                    'name' => $item->name,
                    'status' => ( $item->status )?'Active':'Inactive'
                ]);
            });
            return response()->json(['data' => $jsonCollection]);
        }
        return view('admin.plan-type.listing');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function create(Request $request)
    {
        $planType = [];
        return view('admin.plan-type.create',compact('planType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $planTypesValidator = new PlanTypesValidator();
        try {
            $input = $request->all();
            if (!$planTypesValidator->with($input)->passes()) {
              $request->session()->flash('error', $planTypesValidator->getErrors()[0]);
              return back()
              ->withErrors($planTypesValidator->getValidator())
              ->withInput();
            }

            $planType = new PlanType();
            $sessionMsg = 'Plan type successfully created.';
            if( !empty($request->id) ){
                $planType = $planType->find($request->id);
                $sessionMsg = 'Plan type successfully updated.';
            }
            $planType->name = $request->title;
            $planType->save();
            Session::flash('success',$sessionMsg);
            return redirect(route('admin.plan-type'));
          } catch (\Exception $e) {
              $request->session()->flash('error', $e->getMessage());
              return back()->withInput();
          }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $planType = PlanType::find($id);
        return view('admin.plan-type.create',compact('planType'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Plan::where('plan_type',$id)->delete();
        PlanType::destroy($id);
        Session::flash('success', 'Plan type successfully deleted.');
        return redirect(route('admin.plan-type'));
    }

    public function block($id, $status)
    {
        $update_status = PlanType::where('id', $id)->update(['status' => $status]);
        if ($update_status) {
            return redirect()->back()->with('success', 'Plan type status updated successfully');
        } else {
            return redirect()->back()->with('success', 'Error please try again');
        }
    }

}

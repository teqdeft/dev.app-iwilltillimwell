<?php

namespace App\Http\Controllers\Admin;

use App\Models\Affirmation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Validators\AffirmationValidator;
use App\Validators\AffirmationTypeValidator;

class AffirmationController extends Controller
{
    function index(Request $request){
        try {
            $data = Affirmation::latest('id')->where('type',1)->get();
            if ($request->wantsJson() || $request->ajax()) {
                $jsonCollection = collect();
                $data->each(function ($item, $key) use ($jsonCollection) {
                    $jsonCollection->push([
                        'sr_no'   => $key+1,
                        'id'      => $item->id,
                        'type'    => $item->typeName->message??'',
                        'message' => substr($item->message,0,50)."...",
                    ]);
                });
                return response()->json(['data' => $jsonCollection]);
            }
            return view('admin.affirmation.index',compact('data'));
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    function create(){
        $affirmation = [];  
        $type = Affirmation::where('type',0)->get();
        return view('admin.affirmation.create',compact('affirmation','type'));
    }

    function edit($id){
        $affirmation = Affirmation::where('id',$id)->get();
        $type = Affirmation::where('type',0)->get();
        return view('admin.affirmation.create',compact('affirmation','id','type'));
    }

    function store(Request $request){
        $inputs = $request->all();
        $AffirmationValidator = new AffirmationValidator();
        if (!$AffirmationValidator->with($inputs)->passes()) {
            $request->session()->flash('error', $AffirmationValidator->getErrors()[0]);
            return back()
                ->withErrors($AffirmationValidator->getValidator())
                ->withInput();
        }
        if( !empty($inputs['id']) ){
            Affirmation::where(['id' => $inputs['id']])->update(['parent_type' => $inputs['parent_type'],'message' => $inputs['message']]);
            $msg = "updated";
        }else{
            Affirmation::create($inputs);    
            $msg = "added";
        }
        $request->session()->flash('success', "Affirmation {$msg} successfully");
        return redirect('admin/affirmation');
    }

    function type(Request $request){
        try {
            $data = Affirmation::latest('id')->where('type',0)->get();
            if ($request->wantsJson() || $request->ajax()) {
                $jsonCollection = collect();
                $data->each(function ($item, $key) use ($jsonCollection) {
                    $jsonCollection->push([
                        'sr_no'   => $key+1,
                        'id'      => $item->id,
                        'name' => $item->message,
                    ]);
                });
                return response()->json(['data' => $jsonCollection]);
            }
            return view('admin.affirmation.type.index',compact('data'));
        } catch (\Exception $e) {
            $request->session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

     function typeCreate(){
        $affirmation = [];
        return view('admin.affirmation.type.create',compact('affirmation'));
    }

    function typeEdit($id){
        $affirmation = Affirmation::where('id',$id)->get();
        return view('admin.affirmation.type.create',compact('affirmation','id'));
    }

    function typeStore(Request $request){
        $inputs = $request->all();
        $data['message'] = $inputs['type'];
        $message = "";
        $AffirmationTypeValidator = new AffirmationTypeValidator();
        if (!$AffirmationTypeValidator->with($inputs)->passes()) {
            $request->session()->flash('error', $AffirmationTypeValidator->getErrors()[0]);
            return back()
                ->withErrors($AffirmationTypeValidator->getValidator())
                ->withInput();
        }
        if( !empty($inputs['id']) ){
            Affirmation::where('id',$inputs['id'])->update(['message' => $data['message'] ]);
            $message = "Affirmation type updated successfully";
        }else{
            Affirmation::create($data);
            $message = "Affirmation type added successfully";
        }        
        $request->session()->flash('success', $message);
        return redirect('admin/affirmation/type');
    }

    function delete($id){
        //$data = Affirmation::where('id',$id)->first();
        Affirmation::find($id)->delete();
        Session::flash('success', 'Delete successfully');
        return redirect()->back();
    }

}

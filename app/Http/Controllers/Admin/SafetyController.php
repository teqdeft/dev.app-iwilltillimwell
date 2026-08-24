<?php

namespace App\Http\Controllers\admin;

use App\Models\SafetyPlan;
use Illuminate\Http\Request;
use App\Validators\SafetyValidator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SafetyController extends Controller
{
    function index(Request $request){
        $safetyPlan = SafetyPlan::all()->sortByDesc("id");
        if ($request->wantsJson() || $request->ajax()) {
          $jsonCollection = collect();
          $safetyPlan->each(function ($item, $key) use ($jsonCollection) {
            $img = asset($item->icon);
            $jsonCollection->push([
                    'sr_no'  => $key+1,
                    'id'     => $item->id,
                    'title'  => substr(strip_tags(html_entity_decode($item->title)),0,70),
                    //'number' =>  ($item->number)?$item->number:'N/A',
                    //'description' =>  substr(strip_tags(html_entity_decode($item->description)),0,50),
                    'type'        =>  ucfirst($item->type),
                    'icon'        => "<a href='{$img}' target='_blanck'><img src='{$img}'></a>"
                ]);
            });
            return response()->json(['data' => $jsonCollection]);
        }
        return view('admin.safety.index',compact('safetyPlan'));
    }
    function create(){
        $safetyPlan = [];
        return view('admin.safety.create',compact('safetyPlan'));
    }

    function store(Request $request){
        $input = $request->all();
        $validType = 'add';
        try {
            if( !empty($input['id']) ){
                $validType = 'edit';
            }
            $safetyValidator = new SafetyValidator($validType);
            if (!$safetyValidator->with($input)->passes()) {
              $request->session()->flash('error', $safetyValidator->getErrors()[0]);
              return back()
              ->withErrors($safetyValidator->getValidator())
              ->withInput();
            }

            $safetyPlan = new SafetyPlan();
            $sessionMsg = 'Safety plan successfully created.';
            if( !empty($request->id) ){
              $safetyPlan = $safetyPlan->find($request->id);
              $sessionMsg = 'Safety plan successfully updated.';
            }

            $dir = public_path("uploads/safetyplan/");
            if ($icon = $request->file('icon')) {
              if( !empty($safetyPlan->icon) && file_exists(public_path($safetyPlan->icon)) ){
                unlink(public_path($safetyPlan->icon));
              }
      		  $name = $icon->getClientOriginalName();
              $newname = "safety_".time()."_{$name}";
      		  $file = $icon->move($dir, $newname);
      		  $filePath = "uploads/safetyplan/{$newname}";
              $safetyPlan->icon = $filePath;
            }

            $safetyPlan->title = htmlentities($_POST['title']);
            $safetyPlan->description = htmlentities($_POST['description']);
            $safetyPlan->type = $request->type;
            $safetyPlan->number = $request->number;
            $safetyPlan->inner_description = htmlentities($_POST['inner_description']);
            $safetyPlan->save();

            Session::flash('success',$sessionMsg);
            return redirect(route('admin.safety'));
          } catch (\Exception $e) {
              $request->session()->flash('error', $e->getMessage());
              return back()->withInput();
          }
    }

        public function edit($id){
        $safetyPlan = [];
        if( $id){
            $safetyPlan = SafetyPlan::find($id);
        }
        return view('admin.safety.create',compact('safetyPlan'));
    }

    public function destroy($id)
    {
        $safety = SafetyPlan::find($id);
        if( !empty($safety->icon) && file_exists(public_path($safety->icon)) ){
          unlink(public_path($safety->icon));
        }
        SafetyPlan::destroy($id);
        Session::flash('success', 'Safety plan successfully deleted.');
        return redirect(route('admin.safety'));
    }

}

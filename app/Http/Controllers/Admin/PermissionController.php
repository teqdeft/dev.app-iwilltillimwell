<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Validators\PermissionValidator;
use Session;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         $permission = Permission::all()->sortByDesc("id");
         if ($request->wantsJson() || $request->ajax()) {
             $jsonCollection = collect();
             $permission->each(function ($item, $key) use ($jsonCollection) {
                $jsonCollection->push([
                     'sr_no' => $key+1,
                     'id'   => $item->id,
                     'role' => $item->checkRole->name,
                     'permissions'    => substr(implode(',',array_map('ucfirst_and_remove',json_decode($item->permissions))),0,50)
                 ]);
             });
             return response()->json(['data' => $jsonCollection]);
         }
         return view('admin.permission.listing',compact('permission'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create(Request $request)
     {
         $permission = [];
         $modules = get_all_modules();
         $role    = Role::orderBy('id', 'DESC')->get();
         return view('admin.permission.create',compact('permission','modules','role'));
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {

       try {
           $input = $request->all();
           $permissionValidator = new PermissionValidator('',$request->id);

           if (!$permissionValidator->with($input)->passes()) {
             $request->session()->flash('error', $permissionValidator->getErrors()[0]);
             return back()
             ->withErrors($permissionValidator->getValidator())
             ->withInput();
           }

           $permission = new Permission();
           $sessionMsg = 'Permission successfully created.';
           if( !empty($request->id) ){
             $permission = $permission->find($request->id);
             $sessionMsg = 'Permission successfully updated.';
           }

           $permission->role_id = $request->role_id;
           $permission->permissions = json_encode(array_keys($request->modules));
           $permission->save();

           Session::flash('success',$sessionMsg);
           return redirect(route('admin.permission'));
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
       $permission = [];
       $modules = get_all_modules();
       $role    = Role::orderBy('id', 'DESC')->get();
       if( $id){
         $permission = Permission::find($id);
       }
       return view('admin.permission.create',compact('permission','modules','role'));
     }


     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {

         Permission::destroy($id);
         Session::flash('success', 'Permission successfully deleted.');
         return redirect(route('admin.permission'));
     }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Validators\RoleValidator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $role = Role::all()->sortByDesc("id");
        if ($request->wantsJson() || $request->ajax()) {
            $jsonCollection = collect();
            $role->each(function ($item, $key) use ($jsonCollection) {
                $jsonCollection->push([
                    'id' => $item->id,
                    'sr_no' => $key+1,
                    'name'    => ucfirst($item->name),
                    'status'  => ($item->status)?'Active':'Inactive'
                ]);
            });
            return response()->json(['data' => $jsonCollection]);
        }
        return view('admin.roles.listing');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles = [];
      return view('admin.roles.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
          $roleValidator = new RoleValidator('',$request->name);
          $role = new Role();

          $input = $request->all();

          $sessionMsg = 'Role successfully created.';

          if( !empty($request->id) ){
            $role = $role->find($request->id);
            $sessionMsg = 'Role successfully updated.';
          }

          if (!$roleValidator->with($input)->passes()) {
            $request->session()->flash('error', $roleValidator->getErrors()[0]);
            return back()
            ->withErrors($roleValidator->getValidator())
            ->withInput();
          }

          $role->name = $request->name;
          $role->save();

          Session::flash('success',$sessionMsg);
          return redirect()->back();

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
        $role = [];
        if($id){
          $role = Role::find($id);
        }
        return view('admin.roles.create',compact('role'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        Session::flash('success', 'Role successfully deleted.');
        return redirect(route('admin.roles'));
    }
    
    public function delete(Request $request)
    { 
        $input = $request->all();
        User::where('admin_managers',$input['id'])->update(['admin_managers' => 0]);
        Permission::where('role_id',$input['id'])->delete();
        Role::destroy($input['id']);
        Session::flash('success', 'Role successfully deleted.');
        return redirect(route('admin.roles'));
    }



    public function block($id,$status)
    {
      $update_status = Role::where('id', $id)->update(['status' => $status]);
      if ($update_status) {
          return redirect()->back()->with('success', 'Role Status updated successfully');
      } else {
          return redirect()->back()->with('success', 'Error please try again');
      }
    }
}

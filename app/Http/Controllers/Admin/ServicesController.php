<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Pages;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\CompanyService;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Validators\ServiceValidator;
use Illuminate\Support\Facades\Route;
// NOTE: Intervention\Image\ImageManagerStatic (v2) was removed in intervention/image v3
// (installed here), which caused "Class not found". Uploads now use Laravel's file move.

class ServicesController extends Controller
{
    function index(Request $request){
        $compnay = Company::all()->sortByDesc("id");
        if ($request->wantsJson() || $request->ajax()) {
          $jsonCollection = collect();
          $compnay->each(function ($item, $key) use ($jsonCollection) {
                $img = asset($item->logo);
                $jsonCollection->push([
                    'sr_no' => $key+1,
                    'id' => $item->id,
                    'name' => $item->name,
                    'link' => "<a target='_blank' href='https://www.imwell.app/services/{$item->slug}'>{$item->slug}</a>",
                    'status' => $item->status == "1" ? "Active" : "Inactive",
                    'logo' => "<a href='{$img}' target='_blanck'><img src='{$img}'></a>",
                    'services' => orgServicesName($item->services_status),
                ]);
            });
            return response()->json(['data' => $jsonCollection]);
        }
        return view('admin.services.index',compact('compnay'));
    }


    function create(){
        $pages = Pages::where('slug','!=','')->get();
        return view('admin.services.create',compact('pages'));
    }

    function edit($id){
        $company = [];
        $pages = Pages::where('slug','!=','')->get();
        $data = DB::table('companies')->where('id',$id)->get()->toArray();
        if( !empty($data[0]) && isset($data[0]) ){
            $data = (array) $data[0];
            $companydetails = DB::table('company_services')->where('company_id',$data['id'])->get()->toArray();
            $data['company_service'] = $companydetails;
            $company['company-details'] = ['id' => $data['id'], 'title' => $data['name'],'description' => $data['description'],'image' => $data['logo'],'learn_more' => $data['learn_more'],'slug' =>  $data['slug'] ];
            foreach($data['company_service'] as $key => $value){
                $value = (array) $value;
                if( $value['parent_id'] == 0 ){
                    if( $value['type'] == 'text' && $value['section'] != 'testimonial' ){
                        $company[$value['section']] = ['id' => $value['id'] ,'title' => $value['title'],'description' => $value['description'],'status' => $value['status']??1,'learn_more' => $value['learn_more'] ];
                    }elseif($value['type'] == 'image'){
                        $company[$value['section']]['image'][] = ['image' => $value['image'],'id' => $value['id'] ];
                    }
                }else{
                    $company[$value['section']]['child'][] = ['id' => $value['id'],'title' => $value['title'],'description' => $value['description'] ];
                }
            }

        }
       return view('admin.services.edit',compact('company','pages'));
    }

    function store(Request $request){
        $inputs = $request->all();
        $compnayDetails = [];



        /* $routeCollection = Route::getRoutes(); */
        /* $learnMore = "";
        foreach ($routeCollection as $value) {
            if( $value->uri() == $inputs['learn_more'] ){
                $learnMore = App::call($value->getActionName());
            }
        } */

     //pre($inputs);die;

        try {
            $msg = 'Something is wrong.Try again';
            $destinationPath = public_path('uploads/companies/');


            if( $inputs['company-details'] ){
                $companyData = $inputs['company-details'];
                if( isset($companyData['id']) ){
                    if( isset($inputs['removeImages']) && !empty($inputs['removeImages']) ){
                        CompanyService::destroy($inputs['removeImages']);
                    }
                }
                $compnayDetails = ['name' => $companyData['title'],
                'description' => $companyData['description'],
                'slug' => strToSlug($companyData['slug'],'-'),'learn_more' => $inputs['learn_more'] ];

                if (isset($companyData['image'])) {
                    try{
                        $file = $companyData['image'];
                        $name = 'company-logo-'.time() . '.' . $file->getClientOriginalExtension();
                        $file->move($destinationPath, $name);
                        $compnayDetails = $compnayDetails + ['logo' => "uploads/companies/{$name}" ];
                    }catch(\Exception $e){
                        dd($e->getMessage());
                    }
                }



                if( isset($companyData['id']) ){
                    Company::where('id',$companyData['id'])->update($compnayDetails);
                    $compnayId = $companyData['id'];
                }else{
                    if( !array_key_exists('logo',$compnayDetails) ){
                        $compnayDetails = $compnayDetails + ['logo' => "uploads/companies/jj.png"];
                    }



                    Company::insert($compnayDetails);
                    $compnayId = DB::getPdo()->lastInsertId();;
                }
                if( $compnayId ){
                    if( $inputs['services'] ){
                        $services = $inputs['services'];
                        $servicesData = $_POST['services'];
                        $servicesStatus = [];
                        foreach($services as $section => $value ){
                            $companyTextSections = [
                                    'section' => $section,
                                    'type' => 'text',
                                    'title' => $value['title'],
                                    'description' => $servicesData[$section]['description']??'',
                                    'status' => ((isset($value['status']) && $value['status'] )?1:0),
                                    'learn_more' =>  $value['learn-more']??'',

                            ];
                            $servicesStatus[$section] = ((isset($value['status']) && $value['status'] )?1:0);
                            if( isset($value['id']) ){
                                $compnay = CompanyService::where('id',$value['id'])->update($companyTextSections);
                                $parentId = $value['id'];
                            }else{
                                $companyTextSections = $companyTextSections + ['company_id' => $compnayId];
                                $compnay = CompanyService::create($companyTextSections);
                                $parentId = $compnay->value('id');
                            }

                            if( isset($value['image']) &&  !empty($value['image']) ){
                                $imageSection = [];
                                foreach($value['image'] as $imageKey => $imageValue ){
                                    $file = $imageValue;
                                    $sectionName = "{$section}-{$imageKey}-".time() . '.' . $file->getClientOriginalExtension();
                                    $file->move($destinationPath, $sectionName);
                                    $imageSection = [
                                        'company_id' => $compnayId,
                                        'section' => $section,
                                        'type' => 'image',
                                        'status' => ((isset($value['status']) && $value['status'] )?1:0),
                                        'image' => "uploads/companies/{$sectionName}",
                                        'updated_at' => date('Y-m-d h:i:s'),
                                        'created_at' => date('Y-m-d h:i:s'),
                                    ];
                                    CompanyService::create($imageSection);
                                }
                            }

                            if( isset($value['child']) && !empty($value['child']) ){
                                if( $value['child'] ){
                                    $childSection = [];
                                    $i = 0;
                                    foreach($value['child'] as $childKey => $childValue ){
                                        $childSection = [
                                            'parent_id' => $parentId,
                                            'section' => $section,
                                            'type' => 'text',
                                            'title' => $childValue['title'],
                                            'description' => $childValue['description'],
                                            ];
                                            if( isset($childValue['id']) ){

                                                CompanyService::where('id',$childValue['id'])->update($childSection);
                                            }else{

                                                $childSection['company_id'] = $compnayId;
                                                CompanyService::insert($childSection);
                                            }
                                        }
                                }
                            }
                        }

                        if( $servicesStatus ){
                            Company::where('id',$compnayId)->update(['services_status' => json_encode($servicesStatus)]);
                        }

                    }

                }
                if( isset($companyData['id']) ){
                    $msg = 'updated';
                }else{
                    $msg = 'added';
                }
            }
            $request->session()->flash('success', "Corporate  {$msg} successfully.");
            return redirect('admin/corporate');

        }catch (\Exception $e) {
              $request->session()->flash('error', $e->getMessage());
              return back()->withInput();
          }

    }

    function deleteImages(Request $request){
        $inputs = $request->all();
        $data = CompanyService::find($inputs['id']);
        if( $data && ($data->type == 'image' ) ){
            if( file_exists($data->image) ){
                unlink(public_path($data->image));
            }
        }
        CompanyService::destroy($inputs['id']);
        return true;
    }

    public function status_managment($id, $status)
    {

        $update_status = Company::where('id', $id)->update(['status' => $status]);
        if ($update_status) {
            return redirect()->back()->with('success', 'Corporate Status updated successfully');
        } else {
            return redirect()->back()->with('success', 'Error please try again');
        }
    }


}
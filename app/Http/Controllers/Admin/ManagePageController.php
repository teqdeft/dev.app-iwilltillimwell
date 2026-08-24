<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Validators\Validator;
use App\Models\User;
use App\Models\Rssfeed;
use App\Models\Pages;
use App\Models\PageContents;
use App\Validators\RssValidator;
// use Validator;


class ManagePageController extends Controller
{
    public function index()
    {
        $allPages = Pages::with('dependents')->whereNull('parent_id')->get();
        // $landingPage
        return view('admin.manage-page.index', compact('allPages'));
    }

    public function getlandingPage()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '1')->whereNull('parent_id')->get();
        $page = "Landing Page";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getTeleCounseling()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '10')->whereNull('parent_id')->get();
        $page = "Teletherapy";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }

    public function getAboutGroupCounseling()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '12')->whereNull('parent_id')->get();
        $page = "About Group Counseling";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getWorkingWithAnexity()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '13')->whereNull('parent_id')->get();
        $page = "Working With Anexity";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getHealthyBoundaries()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '14')->whereNull('parent_id')->get();
        $page = "Setting Healthy Boundaries in Relationships";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getGriefLoss()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '15')->whereNull('parent_id')->get();
        $page = "Grief & Loss";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getEmotionRegulations()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '16')->whereNull('parent_id')->get();
        $page = "Emotion Regulations";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getUnderstandingPurpose()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '17')->whereNull('parent_id')->get();
        $page = "Understanding Purpose";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getTelemedicine()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '18')->whereNull('parent_id')->get();
        $page = "Tele Medicine";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getMessageSpecialist()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '19')->whereNull('parent_id')->get();
        $page = "Message A Specialists";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getAdvocacyProgram()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '20')->whereNull('parent_id')->get();
        $page = "Advocacy Program";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getPrescriptionProgram()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '21')->whereNull('parent_id')->get();
        $page = "Prescription Policy";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getProfessionalWelnessPartners()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '22')->whereNull('parent_id')->get();
        $page = "Professional Wellness Partner";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getLegalInformationServices()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '23')->whereNull('parent_id')->get();
        $page = "Legal Information Service";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getMedicalFaq()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '24')->whereNull('parent_id')->get();
        $page = "Medical FAQ";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getCounselingFaq()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '25')->whereNull('parent_id')->get();
        $page = "Counseling FAQ";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getPrescriptionFaq()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '26')->whereNull('parent_id')->get();
        $page = "Prescription FAQ";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getLegalFaq()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '27')->whereNull('parent_id')->get();
        $page = "Legal Informational Services FAQ";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getGroupCounseling()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '28')->whereNull('parent_id')->get();
        $page = "Group Counseling FAQ";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getPetTeleHealth()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '7')->whereNull('parent_id')->get();
        $page = "PET Tele-Health";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }

    public function getAllPetTeleHealth()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '37')->whereNull('parent_id')->get();
        $page = "PET Tele-Health";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }

    public function privacyPolicy()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '39')->whereNull('parent_id')->get();
        $page = "Privacy Policy";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }

    public function termCondiction()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '40')->whereNull('parent_id')->get();
        $page = "Terms & Conditions";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }

    public function getPetFaq()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '38')->whereNull('parent_id')->get();
        $page = "PET FAQ";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }

    public function getEnterpriseEAP()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '8')->whereNull('parent_id')->get();
        $page = "Enterprise EAP";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getPodCasts()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '29')->whereNull('parent_id')->get();
        $page = "Podcasts / Blogs";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getKnowledgeLibrary()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '30')->whereNull('parent_id')->get();
        $page = "Knownledge Library";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getAbout()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '31')->whereNull('parent_id')->get();
        $page = "About";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }

    public function getBiopic()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '33')->whereNull('parent_id')->get();
        $page = "BIOPIC";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getLatinoLantix()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '34')->whereNull('parent_id')->get();
        $page = "LATINO / LATINX";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    public function getlgbtq()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '35')->whereNull('parent_id')->get();
        $page = "LGBTQ";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }
    
    public function brochure()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '41')->whereNull('parent_id')->get();
        $page = "Brochures";
        return view('admin.manage-page.landingpage', compact('pageContents', 'page'));
    }

    public function rssFeeds(Request $request){
        if($request->isMethod('get')){
            $rss = Rssfeed::all();
            return view('admin.manage-page.rssfeeds', compact('rss'));
        }
        
        if($request->isMethod('post')){
            $inputs = $request->all();
            $rss = new RssValidator();
            if (!$rss->with($inputs)->passes()) {
                $request->session()->flash('error', $rss->getErrors()[0]);
                return back()
                ->withErrors($rss->getValidator())
                ->withInput();
            }
            $totaltabs = count($request->input('tab_name'));
            $rssArray = [];
            if( $totaltabs > 0 ){
                for($i = 0;$i < $totaltabs;$i++ ){
                    if( !empty($inputs['tab_name'][$i]) && !empty($inputs['rss_link'][$i]) ){
                        $rssArray['fields'][$i]['tab_name'] = $inputs['tab_name'][$i];
                        $rssArray['fields'][$i]['rss_link'] = $inputs['rss_link'][$i];
                        $rssArray['fields'][$i]['slug']     = strToSlug($inputs['tab_name'][$i],'-');
                    }
                }
            }
            if( isset($rssArray['fields']) && !empty($rssArray['fields']) ){
                Rssfeed::truncate();
                Rssfeed::insert($rssArray['fields']);
                $request->session()->flash('success', 'Topics insert successfuly'); 
            }else{
                $request->session()->flash('error', 'Required all fields');
            }
            return redirect('admin/manage-page/rss-feeds');
        }
    }





    public function updatePage(Request $request)
    {   

        
        $page_id = $request->input('page_id');
        $page_text_data = json_decode($request->input('text-data'));

        foreach ($page_text_data as $row) {
            $pageContentObj = PageContents::where('id', "=", $row->section_id)->first();
            if ($pageContentObj) {
                if( $row->column == 'title' ){
                    $pageContentObj->slug =   strToSlug($row->section_data,'-');
                }
                
                if ($row->column == 'section_content') {
                    $pageContentObj->section_content =   $row->section_data;
                } else {
                    $pageContentObj->section_title =   $row->section_data;
                }
                $pageContentObj->save();
            }
        }

      

        $allFiles = $request->file('files');
        $allFileIds = json_decode($request->input('files_id'));
        if ($allFiles) {
            foreach ($allFiles as $key => $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $location = public_path() . '/uploads/pageFiles/';
                if (chmod($location, 0777)) {
                    chmod($location, 0755);
                }
                $file->move($location, $filename);
                $fileName = 'uploads/pageFiles/' . $filename;
                if ($allFileIds[$key]) {
                    $pageContentObj = PageContents::where('id', "=", $allFileIds[$key])->first();
                    if ($pageContentObj) {
                        $pageContentObj->section_file =  $fileName;
                        $pageContentObj->save();
                    }
                }
            }
        }

        $rows_to_delete = json_decode($request->input('rows_to_delete'));
        if ($rows_to_delete) {
            foreach ($rows_to_delete as $id) {


                $pageContentObj = PageContents::where('id', "=", $id)->first();
                if ($pageContentObj) {
                    $pageContentObj->delete();
                }
            }
        }
        // $request->session()->flash('success', trans('messages.country_info_updated'));
        // return redirect()->back()->with('success', 'Page Update Successfully!');
    }

    public function menu(Request $request){
        $menu = Pages::where('status',1)->orderBy('sort','asc')->get()->toArray();
        $menuHtml = $this->build_menu($menu);
        return view('admin.menu',compact('menuHtml'));
    }

    public function has_children($rows,$id) {
        foreach ($rows as $row) {
            if ($row['parent_id'] == $id)
            return true;
        }
        return false;
    }
    
    public function build_menu($rows,$parent=0)
    {   
        $i = 1;
        $result = "<ol class='dd-list'>";
        foreach ($rows as $row)
        {
            if ($row['parent_id'] == $parent){
                $result.= "<li class='dd-item' data-id='{$row['id']}' data-parent_id='{$row['parent_id']}' data-menu_name='{$row['page_name']}' data-sort='{$i}' >
                                <button class='badge badge-danger-cus editMenuItem' data-menu_name ='{$row['page_name']}'><i class='fas fa-edit'></i></button><div class='dd-handle'><span class='liMenuname'>{$row['page_name']}</span></div>";
                if ($this->has_children($rows,$row['id'])){
                    $result.= $this->build_menu($rows,$row['id']);
                }
                $result.= "</li>";
                $i++;
            }
        }
        $result.= "</ol>";
        return $result;
    }

    function menuCreate(Request $request){
        $input = $request->all();
        $js = json_decode($input['data'],1);

        $array = [];
        $a = $b = $c = 1;
        if($js){
            foreach($js as $parentVal){
                $array[] = ['sort' => $a,'page_name' => $parentVal['menu_name'],
                            'parent_id' => 0,'id' => $parentVal['id'] ];
                if( isset($parentVal['children']) ){
                    foreach($parentVal['children'] as $childval){
                        $array[] = ['sort' => $b,'page_name' => $childval['menu_name'],
                            'parent_id' => $parentVal['id'],'id' => $childval['id'] ];
                        if( isset($childval['children']) ){
                            foreach($childval['children'] as $subVhildval){
                                $array[] = ['sort' => $c,'page_name' => $subVhildval['menu_name'],
                                    'parent_id' => $childval['id'],'id' => $subVhildval['id'] ];
                                $c++;
                            }

                        }
                    $b++;

                    }

                }
            $a++;
            }
        }
        if( $array ){
            foreach($array as $value){
                Pages::where('id',$value['id'])->update(
                    ['sort'      => $value['sort'],
                     'page_name' => $value['page_name'],
                     'parent_id' => $value['parent_id'],  ]
                );
            }
        }
    }


     /**
   * Show the faq.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

}

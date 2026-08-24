<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Support\Facades\Auth;
use Braintree;
use App\Models\Blog;
use App\Models\Plan;
use App\Models\User;
use App\Models\Company;
use App\Models\Rssfeed;
use App\Models\visitor;
use App\Models\Timezones;
use App\Models\States;
use App\Models\UserMood;

use Twilio\Rest\Client;
use App\Mail\ContactMail;
use App\Models\categories;
use App\Models\Affirmation;
use App\Models\Quizanswers;
use App\Models\Quizreviews;
use App\Models\Pages;
use App\Models\PageContents;
use Illuminate\Http\Request;
use App\Models\Quizquestions;
use Visitor as GlobalVisitor;
use App\Models\school_details;
use Illuminate\Support\Facades\DB;
use App\Interfaces\CommonConstants;
use App\Validators\VisitorValidator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use \Exception;
use Carbon\Carbon;


class AppController extends Controller implements CommonConstants
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */

    use AuthenticatesUsers;

  public function __construct()
  {

  }

  /**
   * Show the aboutUs.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function about()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '31')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('app/about', compact('formatedData'));
  }
  /**
   * Show the enterprise erp.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function enterpriseErp()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '8')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    // dd($formatedData);
    return view('app/enterprise-erp', compact('formatedData'));
    // return view('app/enterprise-erp');
  }
  /**
   * Show the petTelehealth erp.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function petTelehealth()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '37')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    
    return view('app/pet-telehealth', compact('formatedData'));
  }

  /*  public function privacyPolicy()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '38')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }

    return view('app/pet-telehealth', compact('formatedData'));
  } */

  public function petFaq()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '38')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    if (isMobile()) {
      return view('mobile.app.faq.pet-faqs', compact('formatedData'));  
    }
    return view('app/pet-faq', compact('formatedData'));
  }
  /**
   * Show the podcatsblogs.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function podcastsBlogs()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '29')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('app/podcasts-blogs', compact('formatedData'));

    // return view('app/podcasts-blogs');
  }
  /**
   * Show the knowledge-library.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function knowledgeLibrary()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '30')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('app/knowledge-library', compact('formatedData'));
    // return view('app/knowledge-library');
  }
  /**
   * Show the accessBipoc.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function accessBipoc()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '33')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('app/access-bipoc', compact('formatedData'));
    // return view('app/access-bipoc');
  }
  /**
   * Show the accessLatino.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function accessLatino()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '34')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('app/access-latino', compact('formatedData'));
  }
  /**
   * Show the accessLgbtq.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function accessLgbtq()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '35')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('app/access-lgbtq', compact('formatedData'));
    // return view('app/access-lgbtq');
  }
  /**
   * Show the Security Platform.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function securityPlatform()
  {
    return view('app/security-platform');
  }

  /**
   * Show the faq.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function medicalFaqs()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '24')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }

    if (isMobile()) {
      return view('mobile.app.faq.medical-faqs', compact('formatedData'));  
    }

    return view('app/medical-faqs', compact('formatedData'));
    // return view('app/medical-faqs');
  }
  /**
   * Show the faq.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function counselingFaqs()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '25')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    if (isMobile()) {
      return view('mobile.app.faq.counseling-faqs', compact('formatedData'));  
    }

    return view('app/counseling-faqs', compact('formatedData'));
    // return view('app/counseling-faqs');
  }
  /**
   * Show the faq.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function prescriptionFaqs()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '26')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    if (isMobile()) {
      return view('mobile.app.faq.prescription-faqs', compact('formatedData'));  
    }

    return view('app/prescription-faqs', compact('formatedData'));
    // return view('app/prescription-faqs');
  }
  /**
   * Show the faq.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function workingAnxiety()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '13')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }

    return view('app/working-anxiety', compact('formatedData'));
    // return view('app/working-anxiety');
  }
  /**
   * Show the faq.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function hgealthyBoundaries()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '14')->whereNull('parent_id')->get();
    $formatedData = [];

    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('app/hgealthy-boundaries', compact('formatedData'));
  }
  /**
   * Show the faq.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function griefLoss()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '15')->whereNull('parent_id')->get();
    $formatedData = [];

    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('app/grief-loss', compact('formatedData'));
  }
  /**
   * Show the faq.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function emotionRegulation()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '16')->whereNull('parent_id')->get();
    $formatedData = [];

    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('app/emotion-regulation', compact('formatedData'));
    // return view('app/emotion-regulation');
  }
  /**
   * Show the faq.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function understandingPurpose()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '17')->whereNull('parent_id')->get();
    $formatedData = [];

    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('app/understanding-purpose', compact('formatedData'));
    // return view('app/understanding-purpose');
  }
  /**
   * Show the faq.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function legalInformational()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '27')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    if (isMobile()) {
      return view('mobile.app.faq.legal-informational-faqs', compact('formatedData'));  
    }
    return view('app/legal-informational', compact('formatedData'));
  }
  /**
   * Show the faq.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function groupcounselingFaq()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '28')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }

    // dd($formatedData);
    if (isMobile()) {
      return view('mobile.app.faq.groupcounseling-faqs', compact('formatedData'));  
    }
    return view('app/groupcounseling-faq', compact('formatedData'));
    // return view('app/groupcounseling-faq');
  }


  /**
   * Show the legalService.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function legalService()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '23')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('app/legal-service', compact('formatedData'));
    // return view('app/legal-service');
  }

  /**
   * Show the legalAdvice.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function agreement()
  {
    return view('app/agreement');
  }

  /**
   * Show the privacyPolicy.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function privacyPolicy()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '39')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }

    if (isMobile()) {
       return view('mobile.app.privacy-policy', compact('formatedData'));  
    }
    return view('app/privacy-policy', compact('formatedData'));
  }

  public function termAndCondiction()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '40')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }

    if (isMobile()) {
      return view('mobile.app.term-condition', compact('formatedData'));  
   }

    return view('app/term-condiction', compact('formatedData'));
  }

  /**
   * Show the privacyPolicy.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function refundPolicy()
  {
    if (isMobile()) {
      return view('mobile.app.refund-policy');  
   }

    return view('app/refund-policy');
  }

  public function supportFaqs()
  {
    $faq_list = Pages::where("parent_id","6")->where("status","1")->orderBy("id","ASC")->get();
    if (isMobile()) {
      return view('mobile.app.support-faqs',compact('faq_list'));  
   }

    return view('app/refund-policy');
  }

  

  /**
   * Show the brochure.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function brochure()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '41')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('app/brochure', compact('formatedData'));
  }

  public function brochureItem($slug)
  {
    $pageContents = PageContents::where('slug', "=", $slug)->get()->toArray();
    return view('app/brochure1', compact('pageContents'));
  }

  /**
   * Show the brochure1.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

  /**
   * Show the blogs.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function blogs($category_id = "")
  {
    if ($category_id) {
      $blogs = Blog::where('category_id', $category_id)->orderBy('id', 'desc')->paginate(12);
    } else {
      $blogs = Blog::orderBy('id', 'desc')->paginate(12);
    }
    $categories = categories::all();
    return view('app/blogs', compact('blogs', 'categories'));
  }

  /**
   * Show the blog-details.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function blogDetails($slug)
  {

    $blog = Blog::where(['slug' => $slug])->first();
    if (!$blog) {
      return abort(404);
    }
    return view('app/blog-details', compact('blog'));
  }

  /**
   * Show the disclaimer.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function disclaimer()
  {
    return view('app/disclaimer');
  }

  /**
   * Show the cookiePolicy.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function cookiePolicy()
  {
    return view('app/cookie-policy');
  }

  public function showRssFeeds(Request $request, $slug)
  {

    try {
      $feed_url = Rssfeed::where('slug', $slug)->first()->toArray();
      $allTabs   = Rssfeed::all();
      if (count($feed_url) <= 0 && !empty($feed_url['rss_link'])) {
        abort(404);
      }
      $xml_data = simplexml_load_file($feed_url['rss_link']);
      $i = 0;
      $xmlData = [];
      foreach ($xml_data->channel->item as $ritem) {
        $xmlData[] = [
          'title' => (string)$ritem->title, 'link' => (string)$ritem->link,
          'pubDate' => (string)$ritem->pubDate, 'description' => (string)$ritem->description,
          'guid' =>  (string)$ritem->guid,
          'encode' => (string)$ritem->children("content", true)->encoded
        ];
      }

      $inspirational = true;
      $healthy = false;
      if ($feed_url['slug'] !=  'inspirational') {
        $inspirational = false;
        $healthy = true;
      }
      return view('rssfeed', compact('xmlData', 'allTabs', 'inspirational', 'healthy'));
    } catch (\Exception $e) {
      dd($e->getMessage());
    }
  }

  function services($slug)
  {

    $data = Company::where('slug', $slug)->get()->toArray();

    if( empty($data) ){
      abort(404);
    }

    try {
      if ($data) {
        $data = $data[0];
      }
      $company_selected = $slug;

      $company = [];
      $xmlData = $this->xmlData();

      if ($data) {
        $company['compnay-details'] = ['id' => $data['id'], 'title' => $data['name'], 'description' => $data['description'], 'image' => $data['logo']];
        foreach ($data['company_service'] as $key => $value) {
          if ($value['parent_id'] == 0) {
            if ($value['type'] == 'text' /* && $value['section'] != 'testimonial' */) {
              $company[$value['section']] = ['id' => $value['id'], 'title' => $value['title'], 'description' => $value['description'], 'status' => $value['status']];
            } elseif ($value['type'] == 'image') {
              $company[$value['section']]['image'][] = ['image' => $value['image'], 'id' => $value['id']];
            }
          } else {
            $company[$value['section']]['child'][] = ['id' => $value['id'], 'title' => $value['title'], 'description' => $value['description']];
          }
          /* if( $value['section'] == 'testimonial' ){
                  $company[$value['section']][] = ['id' => $value['id'] ,'title' => $value['title'],'description' => $value['description'] ];
              } */
        }
      }
      return view('app.services', compact('company', 'xmlData', 'company_selected'));
    } catch (\Exception $e) {
      dd($e->getMessage());
    }
  }
  function anexity($slug)
  {
    try {
      $data = Company::where('slug', $slug)->get()->toArray();
      $company_selected = $slug;
      if ($data) {
        $data = $data[0];
      }

      $company = [];



      if ($data) {
        $company['compnay-details'] = ['id' => $data['id'], 'title' => $data['name'], 'description' => $data['description'], 'image' => $data['logo']];
        foreach ($data['company_service'] as $key => $value) {
          if ($value['parent_id'] == 0) {
            if ($value['type'] == 'text' && $value['section'] != 'testimonial') {
              $company[$value['section']] = ['id' => $value['id'], 'title' => $value['title'], 'description' => $value['description']];
            } elseif ($value['type'] == 'image') {
              $company[$value['section']]['image'][] = ['image' => $value['image'], 'id' => $value['id']];
            }
          } else {
            $company[$value['section']]['child'][] = ['id' => $value['id'], 'title' => $value['title'], 'description' => $value['description']];
          }
          if ($value['section'] == 'testimonial') {
            $company[$value['section']][] = ['id' => $value['id'], 'title' => $value['title'], 'description' => $value['description']];
          }
        }
      }
      $questions = Quizquestions::where('quiz_type', '=', 1)->get();

      $quiz_type = 1;

      if(isMobile()){
        return view('mobile.app.consent', compact('company', 'questions', 'company_selected', 'quiz_type'));
      }

      return view('app.consent', compact('company', 'questions', 'company_selected', 'quiz_type'));
    } catch (\Exception $e) {
      dd($e->getMessage());
    }
  }
  function depression($slug)
  {
    try {
      $data = Company::where('slug', $slug)->get()->toArray();
      $company_selected = $slug;
      if ($data) {
        $data = $data[0];
      }

      $company = [];



      if ($data) {
        $company['compnay-details'] = ['id' => $data['id'], 'title' => $data['name'], 'description' => $data['description'], 'image' => $data['logo']];
        foreach ($data['company_service'] as $key => $value) {
          if ($value['parent_id'] == 0) {
            if ($value['type'] == 'text' && $value['section'] != 'testimonial') {
              $company[$value['section']] = ['id' => $value['id'], 'title' => $value['title'], 'description' => $value['description']];
            } elseif ($value['type'] == 'image') {
              $company[$value['section']]['image'][] = ['image' => $value['image'], 'id' => $value['id']];
            }
          } else {
            $company[$value['section']]['child'][] = ['id' => $value['id'], 'title' => $value['title'], 'description' => $value['description']];
          }
          if ($value['section'] == 'testimonial') {
            $company[$value['section']][] = ['id' => $value['id'], 'title' => $value['title'], 'description' => $value['description']];
          }
        }
      }

      $questions = Quizquestions::where('quiz_type', '=', 2)->get();
      $quiz_type = 2;


      if(isMobile()){
        return view('mobile.app.consent', compact('company', 'questions', 'company_selected', 'quiz_type'));
      }
      return view('app.consent', compact('company', 'questions', 'company_selected', 'quiz_type'));
    } catch (\Exception $e) {
      dd($e->getMessage());
    }
  }

  function abuse($slug)
  {
    try {
      $data = Company::where('slug', $slug)->get()->toArray();
      $company_selected = $slug;
      if ($data) {
        $data = $data[0];
      }

      $company = [];



      if ($data) {
        $company['compnay-details'] = ['id' => $data['id'], 'title' => $data['name'], 'description' => $data['description'], 'image' => $data['logo'],'learn-more' => $data['learn_more']];
        foreach ($data['company_service'] as $key => $value) {
          if ($value['parent_id'] == 0) {
            if ($value['type'] == 'text' && $value['section'] != 'testimonial') {
              $company[$value['section']] = ['id' => $value['id'], 'title' => $value['title'], 'description' => $value['description']];
            } elseif ($value['type'] == 'image') {
              $company[$value['section']]['image'][] = ['image' => $value['image'], 'id' => $value['id']];
            }
          } else {
            $company[$value['section']]['child'][] = ['id' => $value['id'], 'title' => $value['title'], 'description' => $value['description']];
          }
          if ($value['section'] == 'testimonial') {
            $company[$value['section']][] = ['id' => $value['id'], 'title' => $value['title'], 'description' => $value['description']];
          }
        }
      }

      $questions = Quizquestions::where('quiz_type', '=', 3)->get();
      $quiz_type = 3;


      if(isMobile()){
        return view('mobile.app.consent', compact('company', 'questions', 'company_selected', 'quiz_type'));
      }
      return view('app.consent', compact('company', 'questions', 'company_selected', 'quiz_type'));
    } catch (\Exception $e) {
      dd($e->getMessage());
    }
  }


  function xmlData()
  {
    try{
        $mentalHealthLove    = simplexml_load_file("https://loveandlifetoolbox.com/feed/");
        $mentalHealthStudent = simplexml_load_file("https://www.studentmindsblog.co.uk/feeds/posts/default?alt=rss");
        $financialSq = simplexml_load_file("https://squaredawayblog.bc.edu/feed/");
        $xmlData = [];
        $mentalHeal = 0;
        foreach ($mentalHealthLove->channel->item as $ritem) {
          preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $ritem->description, $image);
          preg_match('#^<p.*?>(.*)</p>$#is', $ritem->description, $disp);
          $xmlData['mentalHealth'][$mentalHeal] = [
            'title'        => (string)$ritem->title,
            'image'       => $image['src'] ?? '',
            'link'        => (string)$ritem->link,
            'pubDate'     => (string)$ritem->pubDate,
            'description' => substr(strip_tags($ritem->description), 0, 100),
          ];
          $mentalHeal++;
        }

        foreach ($mentalHealthStudent->channel->item as $ritem) {
          preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $ritem->description, $image);
          preg_match('#^<p.*?>(.*)</p>$#is', $ritem->description, $disp);
          $xmlData['mentalHealth'][$mentalHeal] = [
            'title'        => (string)$ritem->title,
            'image'       => $image['src'] ?? '',
            'link'        => (string)$ritem->link,
            'pubDate'     => (string)$ritem->pubDate,
            'description' => substr(strip_tags($ritem->description), 0, 100),
          ];
          $mentalHeal++;
        }

        $countFinacal = 0;
        foreach ($financialSq->channel->item as $ritem) {
          preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $ritem->description, $image);
          preg_match('#^<p.*?>(.*)</p>$#is', $ritem->description, $disp);
          if ($image) {
            if ($countFinacal < 3) {
              $xmlData['financial'][] = [
                'title'        => (string)$ritem->title,
                'image'       => $image['src'] ?? '',
                'link'        => (string)$ritem->link,
                'pubDate'     => (string)$ritem->pubDate,
                'description' => substr(strip_tags($ritem->description), 0, 100),
              ];
            }
            $countFinacal++;
          }
        }
        return $xmlData;
    }catch(\Exception $e){
      dd($e->getMessage());
    }
  }

  public function saveVisitor(Request $request)
  {
      $VisitorValidator = new VisitorValidator();
      try {
		  
        $input = $request->all();
		$userId    = Auth::user()->id;
        $testType  = $input['test_type'];
		
        if (!$VisitorValidator->with($input)->passes()) {
          echo json_encode(['status' => 0, 'data' => [], 'msg' => $VisitorValidator->getErrors()[0]]);
          die;
        }
        $input = $request->all();
		
		DB::table('visitors as a')->leftJoin('quiz_amswers as b', 'a.id', '=', 'b.visitor_id')
			->where('a.user_id', $userId)
			->where('a.test_type', $testType)
			->whereNull('b.id')
			->delete();
	
		
        $createdAt = Carbon::parse(date("Y-m-d H:i:s"))->startOfHour();
		
		
		$exists = Visitor::where('user_id', $userId)
            ->where('test_type', $testType)
            ->whereBetween('created_at', [$createdAt, $createdAt->copy()->endOfHour()])
            ->exists();

        if($exists) {
            return response()->json([
                'status' => 0,
                'data'   => [],
                'msg'    => 'You can take the test only once per hour. Please try again after one hour.'
            ]);
        }
		
        $visitor = new visitor();
        $visitor->name = Auth::user()->name;
        $visitor->user_id =  Auth::user()->id;
        $visitor->test_type =  $input['test_type'];
        $visitor->created_at = date("Y-m-d H:i:s");
        if($visitor->save()) {
          $school_Detail = new school_details();
          $school_Detail->visitor_id = $visitor->id;
          $school_Detail->name = $input['school_name'];
          $school_Detail->student_id = $input['student_id'];
          $school_Detail->printed_name = $input['prined_date'];
          $school_Detail->mentioned_date =  date("Y-m-d H:i:s", strtotime($input['register_date']));
          $school_Detail->save();
          echo json_encode(['status' => 1, 'data' => ['visitor_id' => $visitor->id, 'school_id' => $school_Detail->id], 'msg' => 'success fully created.']);
          die;
        } else {
          echo json_encode(['status' => 0, 'data' => [], 'msg' => 'Oops! Some error occured.']);
          die;
        }
      } catch (\Exception $e) {
        echo json_encode(['status' => 0, 'data' => [], 'msg' => $e->getMessage()]);
        die;
      }
  }
  public function saveQuizResult(Request $request)
  {
    try {
      $input = $request->all();
      $allAnswers = $input['answers'];
      foreach ($allAnswers as $key => $eachRow) {
        if ($eachRow) {
          $eachAns = new Quizanswers();
          $eachAns->visitor_id = $input['visitor_id'];
          $eachAns->question_id = $key;
          $eachAns->value =  $eachRow;
          $eachAns->save();
        }
      }
      $review = new Quizreviews();
      $review->visitor_id = $input['visitor_id'];
      $review->value = $input['review']??'';
      $review->save();
      echo json_encode(['status' => 1]);
    } catch (\Exception $e) {
      //$request->session()->flash('error', $e->getMessage());
      echo json_encode(['status' => 0,'message'=>$e->getMessage()]);
    
      //return back()->withInput();
    }
  }


  function login(Request $request){
    return view('services.login');
  }

  public function logout(Request $request) {
      $this->guard()->logout();
      $request->session()->invalidate();
      return redirect('services-login');
  }

  
  function pricing(){
    $plain = Plan::where('plan_type','!=',self::ORGANIZATIONID)->get();

    $memberType = $monthPlan = [];

		foreach($plain as $key => $value){
      if( isset($value->planType->status) && $value->planType->status ){
        if( $value->interval == 'monthly' ){
          if( isset($value->member_type) ){
              if( $value->member_type == 1 ){
						    $members = 'Self';
              }elseif( $value->member_type == 2 ){
                $members = 'Self + Family';
              }
              $memberType[$value->member_type] = $members;
              $monthPlan[$value->member_type][$key]['member'] = $members;
              $monthPlan[$value->member_type][$key]['type'] = $value->type;
              $monthPlan[$value->member_type][$key]['name'] = $value->name;
              $monthPlan[$value->member_type][$key]['amount'] = $value->amount;
          }
        }
			}
		}

    return view('app/pricing',compact('monthPlan','memberType'));
  }



  function awmi_pricing(){
		$states = States::all();
		$timezones = Timezones::all();

    if( Auth::check() ){
		$user = User::find(Auth::user()->id);

		$plain = Plan::where('plan_type','!=',self::ORGANIZATIONID)->get();

		$monthPlan = [];
		$totalMonth = $arrayKey = "";

		$user_name = Auth::user()->name;

		foreach($plain as $key => $value){
			if( isset($value->planType->status) && $value->planType->status ){
				if( $value->interval == 'monthly' ){
					$arrayKey = 'Monthly';
					$totalMonth = 1;
				}elseif( $value->interval == 'Quarterly' ){
					$arrayKey = 'Three-Month';
					$totalMonth = 3;
				}
				if( isset($value->member_type) ){
					if( $value->member_type == 1 ){
						$members = 'Self';
					}elseif( $value->member_type == 2 ){
						$members = 'Self + Family';
					}
					if( !empty($arrayKey) ){
						$monthPlan[$arrayKey]['uname']  = $user_name;
						$monthPlan[$arrayKey]['month']  = str_replace('-',' ',$arrayKey);
						$monthPlan[$arrayKey]['members'][$value->member_type] = $members;
						$monthPlan[$arrayKey]['plans'][str_replace(' ','-',$value->planType->name)."_".$value->planType->id] = str_replace(' ','-',$value->planType->name);
						$monthPlan[$arrayKey]['price'][str_replace(' ','-',$value->planType->name)."_".$value->planType->id][$value->member_type] = $value->toArray() + ['totalMonth' => $totalMonth];
					}
				}
			}
		}

		//pre($monthPlan,1);


		$environment = env('BTREE_ENVIRONMENT');
		$gateway = new Braintree\Gateway([
			'environment' => $environment,
			'merchantId' => env('BTREE_MERCHANT_ID'),
			'publicKey' => env('BTREE_PUBLIC_KEY'),
			'privateKey' => env('BTREE_PRIVATE_KEY')
		]);
		$clientToken = $gateway->clientToken()->generate();


		    $startDate = date('Y-m-1');
        $endDate = date('Y-m-t');
        $getGraph = $_GET['graph']??false;

        if( $getGraph  ){
            if( $_GET['graph'] == 'Week' ){
                $startDate = date('Y-m-d',strtotime('-6 Days'));
                $endDate = date('Y-m-d');
            }elseif( $_GET['graph'] == 'Year' ){
                $startDate = date('Y-1-1');
                $endDate = date('Y-12-31');
            }
        }

        $userMood = UserMood::where('user_id',Auth::user()->id)->whereBetween('emoji_date',[$startDate,$endDate])->get()->toArray();

        $currentMonthChart = [];

        foreach($userMood as $key => $value){
            /* Curernt Month Data */
            $date = removeZero(date('d',strtotime($value['emoji_date'])));

            if( $getGraph && $getGraph == 'Year' ){
                $date = removeZero(date('m',strtotime($value['emoji_date'])));
            }

            $currentMonthChart[$value['type']][$date][$value['mood']]['mood_name'] = $value['text'];
            $currentMonthChart[$value['type']][$date][$value['mood']]['mood_count'][] = $value['text'];

        }


        $physically  = chartJsData($currentMonthChart,'physically',$_GET['graph']??'');
        $emotionally = chartJsData($currentMonthChart,'emotionally',$_GET['graph']??'');

		$diffDate = strtotime(date('Y-m-d')) - strtotime(date('Y-m-d',strtotime($user['dob'])));
        $age = date('Y',$diffDate) - 1970;

		$plain = Plan::where('plan_type','!=',self::ORGANIZATIONID)->get();

    $memberType = $monthPlanDouble = [];



    foreach($plain as $key => $value){
      if( isset($value->planType->status) && $value->planType->status ){
        if( $value->interval == 'monthly' ){
          if( isset($value->member_type) ){
              if( $value->member_type == 1 ){
                            $members = 'Self';
              }elseif( $value->member_type == 2 ){
                $members = 'Self + Family';
              }
              $memberType[$value->member_type] = $members;
              $monthPlanDouble[$value->member_type][$key]['id'] = $value->id;
              $monthPlanDouble[$value->member_type][$key]['member'] = $members;
              $monthPlanDouble[$value->member_type][$key]['type'] = $value->type;
              $monthPlanDouble[$value->member_type][$key]['name'] = $value->name;
              $monthPlanDouble[$value->member_type][$key]['amount'] = $value->amount;
          }
        }
        }
      } 

		  return view("app/awmi-pricing", compact(['monthPlanDouble','memberType', 'monthPlan',"states", "user","age","timezones", "clientToken","physically","emotionally"]));
    } else {
      return redirect('awmi-register');
    }
  }











  function contactUs(){

    return view('app/contactus');
  }

   function contactusPost(Request $request) {
/*       $this->validate($request,[
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'required|email',
          'phone' => 'required',
          'message' => 'required'
      ]);
    $data = [
      'subject'=> 'Email Testing',
      'message'=>'testing 123'
    ];

    Mail::to('admin@iwilltilimwell.com')->send(new \App\Mail\ContactMail($data)); */
      return back()->with('success', 'Thank you for contact us!');

  }

  function sendAffirmationToUsers(){
      $affirmationType = Affirmation::where(['type' => 0,'message_send' => 0])->orderBy('id','asc')->first();
      if( $affirmationType ){
            Affirmation::where(['id' => $affirmationType->id])->update(['message_send' => 1]);
            $affirmationMsg = Affirmation::where(['parent_type' => $affirmationType->id,'message_send' => 0 ])->first();
            if( $affirmationMsg ){
              Affirmation::where(['id' => $affirmationMsg->id])->update(['message_send' => 1]);
              DB::table('companies')->update(['affirmation_id' => $affirmationMsg->id ]);
              $userData = User::where(['company_id' => 1,'affirmation_status' => 'yes'])->get();
              foreach($userData as $key => $value){
                if(preg_match('/\+[0-9]{2}+[0-9]/s', $value->primaryPhone)) {
                        $msg = $affirmationMsg->message . "\n" . "iWILL 'til i'mWELL";
                        $this->pushNotification();
                        //$this->sendMsg($value->primaryPhone,$msg);
                  }
              }
            }else{
              $totalMsgNotSend = Affirmation::where(['type' => 1,'message_send' => 0 ])->count();
              if( $totalMsgNotSend == 0 ){
                  Affirmation::where(['type' => 1])->update(['message_send' => 0]);
              }
              $this->sendAffirmationToUsers();
            }
      }else{
        Affirmation::where(['type' => 0])->update(['message_send' => 0]);
        $this->sendAffirmationToUsers();
      }
  }

  function pushNotification(){

      $account_sid = getenv("TWILIO_MSG_ACCOUNT_SID");
      $auth_token = getenv("TWILIO_MSG_AUTH_TOKEN");
      $twilio_number = getenv("TWILIO_FROM");

      $client = new Client($account_sid, $auth_token);
      $service = $client->chat->v2->services("IS7d4b9532bbbcb9aa1343232033df1df9")
                            ->update([
                                         "notificationsAddedToChannelEnabled" => True,
                                         "notificationsAddedToChannelSound" => "default",
                                         "notificationsAddedToChannelTemplate" => "A New message in  from : iiii"
                                     ]
                            );

    print($service->friendlyName);
  }

  function sendMsg($no,$message){
        try {
            $account_sid = getenv("TWILIO_MSG_ACCOUNT_SID");
            $auth_token = getenv("TWILIO_MSG_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);

           $client->messages->create($no, [
                "messagingServiceSid" => "MG643daced9515d9b4687c4089bdb77dd5",
                'from' => $twilio_number,
                'body' => $message]);
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
  }



  public function memberPlan(){


    $plain = Plan::where('plan_type','!=',self::ORGANIZATIONID)->get();

    $memberType = $monthPlan = [];


    // $user_id = auth()->user()->id;

    foreach($plain as $key => $value){

      if( isset($value->planType->status) && $value->planType->status ){
        if( $value->interval == 'monthly' ){
          if( isset($value->member_type) ){
              if( $value->member_type == 1 ){
                            $members = 'Self';
              }elseif( $value->member_type == 2 ){
                $members = 'Self + Family';
              }
              $memberType[$value->member_type] = $members;
              $monthPlan[$value->member_type][$key]['member'] = $members;
              $monthPlan[$value->member_type][$key]['type'] = $value->type;
              $monthPlan[$value->member_type][$key]['name'] = $value->name;
              $monthPlan[$value->member_type][$key]['amount'] = $value->amount;
          }
        }
        }
      }

    return view('auth/memberPlan', compact('monthPlan','memberType'));

    // return view('auth/memberPlan');
}

  /**
   * Show the account deactivate steps page.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function accountDeactivate()
  {
    return view('app/account-deactivate');
  }

  public function mentalHealthScreening() {
	  if(isMobile()){
		return view('mobile.app.mental-health-screening.page');  
	  }
    return view('app.mental-health-screening.page');
  }  

}

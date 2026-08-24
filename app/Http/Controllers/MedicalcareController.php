<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageContents;

class MedicalcareController extends Controller
{

  /**
   * Show the Telemedicine.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function telemedicine()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '18')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }


    return view('medicalcare/telemedicine', compact('formatedData'));
    // return view('medicalcare/telemedicine');
  }

  /**
   * Show the Advocay Program.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function advocayProgram()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '20')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('medicalcare/advocay-program', compact('formatedData'));
  }
  /**
   * Show the Advocay Program.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function prescriptionPolicy()
  {
    $pageContents = PageContents::with('dependents')->where('page_id', "=", '21')->whereNull('parent_id')->get();
    $formatedData = [];
    foreach ($pageContents as $eachRow) {
      $formatedData[$eachRow->section_name] = [];
      $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
      $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
      $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
      $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
      $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
    }
    return view('medicalcare/prescription-policy', compact('formatedData'));
    // return view('medicalcare/prescription-policy');
  }
}

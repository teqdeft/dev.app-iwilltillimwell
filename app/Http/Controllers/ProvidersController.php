<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageContents;

class ProvidersController extends Controller
{

    /**
     * Show the providers.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function providers()
    {

        return view('providers/index');
    }

    /**
     * Show the Menthal Health Professionals.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mentalHealthProfessionals()
    {
        return view('providers/mental-health-professionals');
    }

    /**
     * Show the professional Welllness Partners
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function professionalWelllnessPartners()
    {
        $pageContents = PageContents::with('dependents')->where('page_id', "=", '22')->whereNull('parent_id')->get();
        $formatedData = [];
        foreach ($pageContents as $eachRow) {
            $formatedData[$eachRow->section_name] = [];
            $formatedData[$eachRow->section_name]['content'] =  $eachRow->section_content;
            $formatedData[$eachRow->section_name]['section_title'] =  $eachRow->section_title;
            $formatedData[$eachRow->section_name]['section_file'] =  $eachRow->section_file;
            $formatedData[$eachRow->section_name]['type'] =  $eachRow->type;
            $formatedData[$eachRow->section_name]['children'] =  $eachRow->dependents;
        }
        return view('providers/professional-welllness-partners', compact('formatedData'));
        // return view('providers/professional-welllness-partners');
    }

    /**
     * Show the organizations.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function organizations()
    {
        return view('providers/organizations');
    }
}

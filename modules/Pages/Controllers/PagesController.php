<?php

namespace Modules\Pages\Controllers;

use App\Models\UserMeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    public function termsOfUse(){
        $viewName = __FUNCTION__;
        return view("Pages::{$viewName}");
    }

    public function hippaPrivacyPolicy(){
        $viewName = __FUNCTION__;
        return view("Pages::{$viewName}");
    }

    public function updateCompleteSetup(Request $request){
        UserMeta::consentUpdate(['meta_key' => 'checkAppComplete','meta_value' => 1]);
    }


}

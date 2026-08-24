<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class HealthStep extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    private $request;

    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $steps = [];
        $healthStep = Auth::user()->doctor_step;
        $explode = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $explodeCheck = isset($explode[1])?$explode[1]:'';

        if( $explodeCheck == 'imwell' ){
            $explodeCheck = isset($explode[2])?$explode[2]:'';
        }

        switch($explodeCheck){
            case 'personal-record':
                    $steps['dn'] = 'display:none;';
                    //$steps['prev'] = $_SERVER['HTTP_REFERER']??url('personal-record');
                    $steps['next'] = url('medications');
            break;
            case 'medications':
                    $steps['dn'] = 'display:none;';
                    $steps['prev'] = url('personal-record');
                    $steps['next'] = url('medication-allergies');
            break;
            case 'medication-allergies':
                    $steps['dn'] = 'display:none;';
                    $steps['prev'] = url('medications');
                    $steps['next'] = url('medical-history');
            break;
            case 'medical-history':
                    $steps['dn'] = '';
                    $steps['prev'] = url('medication-allergies');
                    $steps['next'] = url('document-manager');
            break;
        }
        return view('components.health-step',compact('healthStep','steps','explodeCheck'));
    }
}

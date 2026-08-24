<?php

namespace App\Validators\User;

use App\Validators\Validator;
use Config;

class ProfileValidator extends Validator 
{
    /**
     * Rules for Lab User registration
     *
     * @var array
     */
    protected $rules;

    /**
     * Messages for User registration
     *
     * @var array
     */
    protected $messages = [];

    public function __construct($validationFor = 'add')
    {
        $this->messages = [
            'password.regex' => trans('messages.password_regex'),
            'toc.accepted' => trans('messages.toc_accepted'),
            'logo.dimensions' => trans('messages.dimensions_invalid'),
            'signature.dimensions' => trans('messages.dimensions_invalid'),
        ];
        $this->rules = [];

        switch ($validationFor) {
            
            case 'updatePassword':
                $additionalRules = [
                    'current_password' => 'nullable|required_with:password|string|min:6',
                    'password' => 'nullable|required_with:current_password|string|min:6|confirmed|different:current_password'
                ];
                break;
            case 'update':
                $additionalRules = [
                    'primaryPhone' => 'required',
                    'address' => 'required|string|min:3|max:550',
                    'city' => 'required|string|min:3|max:255',
                    'stateid' => 'required',
                    'zipCode' => 'required',
                    'timezoneId' => 'required',
                    'gender' => 'required',
                ];
            break;
            case 'api_update':
                $additionalRules = [
                    'name' => 'required|string|min:2|max:255',
                    'password' => 'nullable|string|min:6|confirmed|different:current_password',
                    'password_confirmation' => 'nullable|string|min:6',
                    'current_password' => 'nullable|required_with:password|string|min:6'
                ];
                break;
            case 'company':
                $additionalRules = [
                    'role' => 'required|string|min:3|max:255',
                    'address' => 'required|string|min:3|max:255',
                    'city' => 'required|string|min:3|max:255',
                    'country' => 'required',
                    'phone' => 'required|string|min:10|max:12|regex:/[0-9]{9}/',
                    'logo' => 'nullable|image|mimes:jpeg,bmp,png,jpg',
                    // |dimensions:min_width=300,min_height=300',
                    'signature' => 'nullable|image|mimes:jpeg,bmp,png,jpg',
                    // |dimensions:min_width=300,min_height=150',
                ];
                break;
            case 'api_address_update':
                $additionalRules = [
                    'state' => 'required|string|min:2|max:255',
                    'address' => 'required|string|min:3|max:255',
                    'city' => 'required|string|min:3|max:255',
                    'country' => 'required',
                    'logo' => 'nullable|image|mimes:jpeg,bmp,png,jpg',
                ];
                break;
            
            default:
                $additionalRules = [
                    'logo' => 'nullable|image|mimes:jpeg,bmp,png,jpg',
                ];
                break;
        }
        $this->rules = array_merge($this->rules, $additionalRules);
    }
}

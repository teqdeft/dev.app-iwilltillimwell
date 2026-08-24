<?php

namespace App\Validators\User;

use App\Validators\Validator;
use Config;

class CompanyUserValidator extends Validator 
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

    public function __construct($validationFor = 'add', $user = null)
    {
        $this->messages = [];

        $this->rules = [
            'name' => 'required|string|min:3|max:255',
            'role' => 'required_without:permissions',
            'permissions' => 'required_without:role'
        ];

        switch ($validationFor) {
            case 'add':
                $additionalRules = [
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed',
                ];
                break;
            case 'update':
                $additionalRules = [
                    'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
                    'password' => 'nullable|string|min:6|confirmed'
                ];
                break;
            
            default:
                $additionalRules = [
                    'image' => 'nullable|image|mimes:jpeg,bmp,png,jpg',
                ];
                break;
        }
        $this->rules = array_merge($this->rules, $additionalRules);
    }
}

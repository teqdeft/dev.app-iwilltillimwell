<?php

namespace App\Validators\User;

use App\Validators\Validator;

class LoginValidator extends Validator 
{
    /**
     * Rules for User login
     *
     * @var array
     */
    protected $rules = [
        'email'     => 'required|string|email|max:255',
        'password' => 'required|string|min:6'
    ];

    /**
     * Messages for User login
     *
     * @var array
     */
    protected $messages = [];

    public function __construct()
    {
        $this->messages = [
            'password.regex' => trans('messages.password_regex')
        ];
    }

}
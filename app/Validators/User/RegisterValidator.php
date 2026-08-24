<?php

namespace App\Validators\User;

use App\Validators\Validator;

class RegisterValidator extends Validator
{

    /**
     * Rules for client creation and updation.
     *
     * @var array
     */
    protected $rules;

    /**
     * Messages for Client registration
     *
     * @var array
     */
    protected $messages = [];

    public function __construct($validationFor = 'add')
    {
        $this->rules = [
            'fname' => 'required|string|min:3|max:255',
            'lname' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'primaryPhone' => 'nullable|min:10|max:12|unique:users|regex:/[0-9]{9}/',
            'dob' => 'nullable|date_format:m/d/Y',
          
        ];

        if ($validationFor == 'update') {
            $rulesForUpdate = [
                'password' => 'nullable|string|min:6',
                'email' => 'required|string|email|max:255'
            ];
            $this->rules = array_merge($this->rules, $rulesForUpdate);
			 unset($this->rules['primaryPhone']);
        }
    }

    public function getRules() {
        return $this->rules;
    }


}

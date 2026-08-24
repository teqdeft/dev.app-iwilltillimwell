<?php

namespace App\Validators\User;

use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class DependentValidator extends Validator 
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

    public function __construct($validationFor = 'add', $dependent = null)
    {
        $this->rules = [
            'fname' => 'required|string|min:3|max:255',
            'lname' => 'required|string|min:3|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            /* 'password' => 'required|string|min:6', */
            'primaryPhone' => 'required',
            'address' => 'required|string|min:3|max:550',
            'city' => 'required|string|min:3|max:255',
            'stateid' => 'required',
            'zipCode' => 'required',
            'timezoneId' => 'required',
            'gender' => 'required',
            'dob' => 'required',
        ];

        if ($validationFor == 'update') {
            $rulesForUpdate = [
                'fname' => 'nullable|string|min:3|max:255',
                'lname' => 'nullable|string|min:3|max:255',
                'dob' => 'nullable',
               /*  'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->where(function ($query) {
                    return $query;
                })->ignore($dependent->id)], */
            ];
            $this->rules = array_merge($this->rules, $rulesForUpdate);
        }
    }

    public function getRules() {
        return $this->rules;
    }

}
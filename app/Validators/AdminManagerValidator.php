<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class AdminManagerValidator extends Validator
{
    /**
     * Rules for Item Category creation and updation.
     *
     * @var array
     */
    protected $rules;

    /**
     * Messages for Item Category
     *
     * @var array
     */
    protected $messages = [];

    public function __construct($validationFor = 'add',$email="")
    {
        $this->rules = [
          'first_name' => 'required|string|min:3|max:255',
          'last_name' => 'required|string|min:3|max:255',
          'email' => 'required|string|email|max:255|unique:users,email,'.$email,
          'genders' => 'required',
          'timezone' => 'required',
          'zipcode' => 'required',
          'state' => 'required',
          'city' => 'required|string',
          'primaryphone' => 'nullable|min:10|max:12|regex:/[0-9]{9}/',
        ];
    }

    public function getRules() {
        return $this->rules;
    }
}

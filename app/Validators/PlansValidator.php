<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;

class PlansValidator extends Validator
{
    protected $rules;

    /**
     * Rules for User login
     *
     * @var array
     */
    protected $messages = [];

    public function __construct()
    {
        $this->rules = [
            'type' => 'required',
            'name' => 'required|string|max:50',
            'interval' => 'required',
            'member_type' => 'required',
            'amount' => 'required|numeric|gt:0|regex:/^-?[0-9]{1,10}+(?:.[0-9]{1,2})?$/',
        ];
    }

    public function getRules()
    {
        return $this->rules;
    }
}

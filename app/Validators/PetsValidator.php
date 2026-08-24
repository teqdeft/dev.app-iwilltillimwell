<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;

class PetsValidator extends Validator
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
            'name' => 'required|string|max:50',
            'gender' => 'required',
            'species' => 'required',
            'months' => 'required',
            'years' => 'required',
        ];
    }

    public function getRules()
    {
        return $this->rules;
    }
}

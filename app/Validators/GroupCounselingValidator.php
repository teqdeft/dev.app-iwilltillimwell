<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;


class GroupCounselingValidator extends Validator
{
    protected $rules;

    /**
     * Rules for User login
     *
     * @var array
     */
    protected $messages = [];

    public function __construct($validationFor = 'add')
    {
        $this->rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'minimum_number_of_users' => 'required|max:255',
            'maximum_number_of_users' => 'required|max:255',
            'counseler_id' => 'required',
            'registration_fee' => 'required|max:255',
            'last_registration_date' => 'required'
        ];
    }

    public function getRules()
    {
        return $this->rules;
    }
}

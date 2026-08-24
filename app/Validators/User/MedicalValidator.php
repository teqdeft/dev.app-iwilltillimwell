<?php

namespace App\Validators\User;


use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class MedicalValidator extends Validator 
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

    public function __construct($validationFor = 'add')
    {
        $this->rules = [
            'medicalConditionName' => 'required',
            'medicalConditionDescription' => 'required',
            'medicalConditionStatus' => 'required'
        ];
    }

    public function getRules() {
        return $this->rules;
    }
}

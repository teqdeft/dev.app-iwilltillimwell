<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class MedicationValidator extends Validator 
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
            'medicationName' => 'required',
            'medicationFrequency' => 'required',
            'medicationComment' => 'required',
            'medicationCurrentUse' => 'required',
            'medicationForeignId' => 'required',
            'medicationNDC' => 'required',
        ];
    }

    public function getRules() {
        return $this->rules;
    }
}

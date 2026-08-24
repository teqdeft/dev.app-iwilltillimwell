<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class ServiceValidator extends Validator
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
            'services[banner][title]' => 'required',
            'company-details[title]' => 'required',
            'company-details[image]' => 'required',
        ];
    }

    public function getRules() {
        return $this->rules;
    }
}

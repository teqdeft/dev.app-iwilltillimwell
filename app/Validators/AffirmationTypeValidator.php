<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class AffirmationTypeValidator extends Validator
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

    public function __construct()
    {
        $this->rules = [
            'type' => 'required',
        ];
    }

    public function getRules() {
        return $this->rules;
    }
}

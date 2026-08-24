<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class SafetyValidator extends Validator
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

    public $validateEdit = "";

    public function __construct($validationFor = 'add')
    {
        
        $this->validateEdit = $validationFor;

        $this->rules = [
                'title' => 'required',
                'type'  => 'required',
                'icon'  => ( $this->validateEdit == 'edit'  )? 'mimes:jpeg,jpg,png,svg':'required|mimes:jpeg,jpg,png,svg',
        ];
    }

    public function getRules() {
        return $this->rules;
    }
}

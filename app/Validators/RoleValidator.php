<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class RoleValidator extends Validator
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

    public function __construct($validationFor = 'add',$name)
    {
        $this->rules = [
            'name' => 'required|unique:roles,name,'.$name,
        ];
    }

    public function getRules() {
        return $this->rules;
    }
}

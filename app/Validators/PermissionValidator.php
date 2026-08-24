<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class PermissionValidator extends Validator
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

    public function __construct($validationFor = 'add',$role_id)
    {

        $this->rules = [
            'role_id' => 'required|unique:permissions,role_id,'.$role_id,
            'modules' => 'required',
        ];
    }

    public function getRules() {
        return $this->rules;
    }
}

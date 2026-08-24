<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class UserMoodValidator extends Validator
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
            'physicallyParent'    => 'required',
            'physicallyChild'     => 'required',
            'physicallySubChild'  => 'required',
           /*  'emotionallyParent'   => 'required',
            'emotionallyChild'    => 'required',
            'emotionallySubChild' => 'required' */
        ];
    }

    public function getRules()
    {
        return $this->rules;
    }
}

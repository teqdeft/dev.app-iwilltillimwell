<?php

namespace Modules\SharingPreference\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class AddSupporterValidator extends Validator
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
            'first_name'    => 'required',
            'last_name'     => 'required',
            'relation'      => 'required',
            'email'          => 'required|email',
            'phone'         => 'required',
            'frequency'     => 'required',
        ];
    }

    public function getRules()
    {
        return $this->rules;
    }
}

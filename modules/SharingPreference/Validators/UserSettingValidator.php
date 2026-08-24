<?php

namespace Modules\SharingPreference\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class UserSettingValidator extends Validator
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
            'name'              => 'required',
            'email'             => 'required|email',
            'phone'             => 'required',
            'relation'          => 'required',
            'share_frequency'   => 'required',
            'share_information' => 'required',
        ];
    }

    public function getRules()
    {
        return $this->rules;
    }
}

<?php

namespace Modules\SharingPreference\Validators;


use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class GeneralInformationValidator extends Validator
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
            'fullname'              => 'required',
            'gender'                => 'required',
            'dob'                   => 'required',
            'home_address'          => 'required',
            'About_iWILLtilimWELL'  => 'required',
            'medical_care'          => 'required',
            'counseling'            => 'required',
        ];
    }

    public function getRules()
    {
        return $this->rules;
    }
}

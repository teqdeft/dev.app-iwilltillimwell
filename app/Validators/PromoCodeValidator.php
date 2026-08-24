<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;

class PromoCodeValidator extends Validator 
{
    protected $rules;

    /**
     * Rules for User login
     *
     * @var array
     */
    protected $messages = [];

    public function __construct($validationFor = 'add')
    {
        $this->rules = [
            'code' => 'required|max:255',
            'valid_from' => 'required|date_format:Y-m-d',
            'valid_to' => 'required|date_format:Y-m-d',
            'influencer_id'     => 'required',
            'influencer_commission_type' => 'required',
            'influencer_commission_amount' => 'required|numeric|gt:0|regex:/^-?[0-9]{1,10}+(?:.[0-9]{1,2})?$/',
            'allowed_members' => 'required|integer|max:5000',
            'member_discount_type' => 'required'
        ];
    }

    public function getRules() {
        return $this->rules;
    }

}
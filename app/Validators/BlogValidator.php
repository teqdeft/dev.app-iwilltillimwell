<?php

namespace App\Validators;

use App\Validators\Validator;
use Illuminate\Validation\Rule;
use Auth;

class BlogValidator extends Validator
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
            'title' => 'required',
            'category_id' => 'required',
            'banner' => 'mimes:jpeg,jpg,png',
            'thumbnail' => 'mimes:jpeg,jpg,png'
        ];
    }

    public function getRules() {
        return $this->rules;
    }
}

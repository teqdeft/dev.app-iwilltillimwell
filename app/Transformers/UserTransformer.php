<?php

namespace App\Transformers;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use App\Transformers\AddressTransformer;

class UserTransformer
{
	public function singleTransform($user)
	{
		return [
			'fname' => $user->fname,
			'lname' => $user->lname,
			'email' => $user->email,
			'phone' => $user->primaryPhone,
			'dob' => $user->dob,
			'gender' => $user->gender,
			'timezoneId' => $user->timezoneId,
		];
	}
}
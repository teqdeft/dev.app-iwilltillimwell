<?php

namespace App\Transformers;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class TimezoneTransformer
{
	public function transform($timezones)
	{
		// Create a top level instance somewhere
		$fractal = new Manager();

		$resource = new Collection($timezones, function($timezones) {
			return [
				'id' => $timezones->id,
				'name' => $timezones->name,
			];
		});
		$resource = $fractal->createData($resource)->toArray();
		return $resource["data"];
	}
}
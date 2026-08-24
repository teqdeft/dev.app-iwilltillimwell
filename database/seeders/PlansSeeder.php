<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::insert([ 
            [
                'name' => '1 month',
                'amount' => 49.87,
                'type' => 'self',
                'interval' => 'monthly',
            ],
            [
                'name' => '3 months',
                'amount' => 140.87,
                'type' => 'self',
                'interval' => 'quarterly',
            ],
            [
                'name' => '6 months',
                'amount' => 279.22,
                'type' => 'self',
                'interval' => 'semiannual',
            ],
            [
                'name' => '12 months',
                'amount' => 568.44,
                'type' => 'self',
                'interval' => 'yearly',
            ],
            [
                'name' => '1 month',
                'amount' => 69.87,
                'type' => 'self and family',
                'interval' => 'monthly',
            ],
            [
                'name' => '3 months',
                'amount' => 199.77,
                'type' => 'self and family',
                'interval' => 'quarterly',
            ],
            [
                'name' => '6 months',
                'amount' => 399.22,
                'type' => 'self and family',
                'interval' => 'semiannual',
            ],
            [
                'name' => '12 months',
                'amount' => 798.88,
                'type' => 'self and family',
                'interval' => 'yearly',
            ],
            [
                'name' => '1 month',
                'amount' => 79.87,
                'type' => 'premium',
                'interval' => 'monthly',
            ],
            [
                'name' => '3 months',
                'amount' => 299.77,
                'type' => 'premium',
                'interval' => 'quarterly',
            ],
            [
                'name' => '6 months',
                'amount' => 499.22,
                'type' => 'premium',
                'interval' => 'semiannual',
            ],
            [
                'name' => '12 months',
                'amount' => 898.88,
                'type' => 'premium',
                'interval' => 'yearly',
            ],
        ]);
    }
}

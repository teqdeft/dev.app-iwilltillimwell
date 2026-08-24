<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFinalColumnsToBraintreeSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('braintree_subscription', function (Blueprint $table) {
            
			$table->decimal('final_amount', 10, 2)
                  ->nullable()
                  ->comment('Add Final Amount ')
                  ->after('amount');
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('braintree_subscription', function (Blueprint $table) {
            
			$table->dropColumn(['final_amount']);
			
			
        });
    }
}

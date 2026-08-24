<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProRataColumnsToBraintreeSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('braintree_subscription', function (Blueprint $table) {
            
			$table->unsignedInteger('pro_rata_days')->default(0)->after('amount');
            $table->decimal('pro_rata_amount', 10, 2)->default(0.00)->after('pro_rata_days');
			
			
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
            $table->dropColumn(['pro_rata_days', 'pro_rata_amount']);
        });
    }
}

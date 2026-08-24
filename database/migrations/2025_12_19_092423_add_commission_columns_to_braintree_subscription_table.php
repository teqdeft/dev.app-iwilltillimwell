<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommissionColumnsToBraintreeSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('braintree_subscription', function (Blueprint $table) {
            
			$table->decimal('commission_rate', 5, 2)->nullable()->after('amount');
            $table->decimal('commission_amount', 10, 2)->nullable()->after('commission_rate');
			
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
            
			$table->dropColumn(['commission_rate', 'commission_amount']);

        });
    }
}

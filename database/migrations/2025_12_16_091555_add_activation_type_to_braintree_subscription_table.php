<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivationTypeToBraintreeSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('braintree_subscription', function (Blueprint $table) {
			$table->string('activation_type')->nullable()->after('subscription_status');
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
             $table->dropColumn('activation_type');
        });
    }
}

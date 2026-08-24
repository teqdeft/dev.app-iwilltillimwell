<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFreeTrialToBraintreeSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('braintree_subscription', function (Blueprint $table) {
           $table->integer('free_trial_days')->default(0)->after('terms_accepted');
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
            $table->dropColumn('free_trial_days');
        });
    }
}

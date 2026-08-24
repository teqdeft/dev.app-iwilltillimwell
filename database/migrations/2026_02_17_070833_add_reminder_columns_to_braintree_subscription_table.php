<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReminderColumnsToBraintreeSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('braintree_subscription', function (Blueprint $table) {
            
			$table->boolean('reminder_5_sent')->default(false)->after('subscription_end_date');
            $table->boolean('reminder_1_sent')->default(false)->after('reminder_5_sent');


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
            $table->dropColumn(['reminder_5_sent', 'reminder_1_sent']);

        });
    }
}

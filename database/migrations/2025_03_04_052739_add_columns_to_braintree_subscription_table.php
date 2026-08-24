<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBraintreeSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('braintree_subscription', function (Blueprint $table) {

            $table->text('package_service_list')->nullable()->after('promo_code_value');
            $table->text('optional_service')->nullable()->after('package_service_list');
            $table->decimal('optional_amount', 10, 2)->nullable()->after('optional_service');

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
            
            $table->dropColumn(['package_service_list', 'optional_service', 'optional_amount']);

        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBraintreeTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('braintree_transactions', function (Blueprint $table) {
            $table->bigInteger('counseling_id')->nullable()->unsigned()->after('plan_id');
            $table->foreign('counseling_id')->references('id')->on('group_counselings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('braintree_transactions', function (Blueprint $table) {
            $table->dropColumn('counseling_id');
        });
    }
}

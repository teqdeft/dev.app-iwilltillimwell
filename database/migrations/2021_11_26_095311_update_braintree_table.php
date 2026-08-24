<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBraintreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('braintree_transactions', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
            $table->bigInteger('plan_id')->nullable()->unsigned()->change();
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->enum('transaction_type', ['counseling', 'plan'])->default('plan');
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
            //$table->dropColumn('plan_id');
            $table->dropColumn('transaction_type');
        });
    }
}

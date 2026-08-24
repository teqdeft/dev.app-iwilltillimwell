<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BraintreeTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('braintree_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('plan_id')->unsigned();
            $table->foreign('plan_id')->references('id')->on('plans');
            $table->double('amount', 15, 2);
            $table->string('status')->nullable();
            $table->string('transaction_id');
            $table->bigInteger('promo_code_id')->unsigned()->nullable();
            $table->foreign('promo_code_id')->references('id')->on('promocodes');
            $table->double('promo_code_amount', 15, 2)->nullable();
            $table->double('final_amount', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('braintree_transactions');
    }
}

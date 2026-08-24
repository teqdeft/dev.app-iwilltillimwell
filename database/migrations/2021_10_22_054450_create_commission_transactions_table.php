<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('promo_code_id')->unsigned();
            $table->foreign('promo_code_id')->references('id')->on('promocodes');
            $table->bigInteger('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('users');
            $table->bigInteger('influencer_id')->unsigned();
            $table->foreign('influencer_id')->references('id')->on('users');
            $table->enum('influencer_type',['individual','organization'])->default('individual');
            $table->enum('status',[0,1])->default(0);
            $table->string('influencer_payable_amount')->nullable();
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
        Schema::dropIfExists('commission_transactions');
    }
}

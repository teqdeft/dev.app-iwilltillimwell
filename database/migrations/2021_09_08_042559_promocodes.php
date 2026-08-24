<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Promocodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('promocodes', function (Blueprint $table) {
        $table->id();
        $table->string('code',255);
        $table->date('valid_from');
        $table->date('valid_to');
        $table->string('influencer_name');
        $table->string('influencer_email')->unique();
        $table->enum('commission_type',['fixed','percentage']);
        $table->integer('commission_amount');
        $table->integer('allowed_members');
        $table->enum('member_commission_type',['fixed','percentage']);
        $table->integer('member_commission_amount');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promocodes');
    }
}

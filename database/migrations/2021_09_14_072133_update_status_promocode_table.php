<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusPromocodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promocodes', function (Blueprint $table) {
            $table->TinyInteger('status')->comment('0 => Pending, 1 => Paid')->default('0')->after('influencer_email');
            $table->string('influencer_payable_amount')->nullable()->after('commission_amount');
            
            });
            Schema::table('users', function (Blueprint $table) {
                $table->Integer('promo_code_id')->nullable();
                
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promocodes', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('promocodes', function (Blueprint $table) {
            $table->dropColumn('influencer_payable_amount');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('promo_code_id');
        });
    }
}


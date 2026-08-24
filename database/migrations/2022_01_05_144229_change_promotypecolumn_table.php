<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePromotypecolumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promocodes',function(Blueprint $table){
            $table->decimal('influencer_commission_amount')->change();
            $table->decimal('member_discount_amount')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promocodes',function(Blueprint $table){
            $table->int('influencer_commission_amount')->change();
            $table->int('member_discount_amount')->change();
        });
    }
}

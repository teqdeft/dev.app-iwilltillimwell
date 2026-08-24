<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMemberTypeFieldPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans',function(Blueprint $table){
            $table->integer('member_type')->nullable()->comment('1 = self, 2 = self + member')->after('plan_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans',function(Blueprint $table){
            $table->dropColumn('member_type');
        });
    }
}

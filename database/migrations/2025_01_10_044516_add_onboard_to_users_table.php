<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOnboardToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            //$table->integer('onboard')->default(0)->comment('"0"=>"pending", "1"=>"completed"');
            $table->enum('onboard', ['0', '1'])->default("0")->comment('"0"=>"pending", "1"=>"completed"');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('onboard');

        });
    }
}

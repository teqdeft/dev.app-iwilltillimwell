<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolColumnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function(Blueprint $table){
            $table->string('school_name')->after('primaryExternalId')->nullable();
            $table->string('school_address')->after('school_name')->nullable();
            $table->string('school_contact')->after('school_address')->nullable();
            $table->string('school_member')->after('school_contact')->nullable();
            $table->string('school_year')->after('school_member')->nullable();
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
            $table->dropColumn('school_name');
            $table->dropColumn('school_address');
            $table->dropColumn('school_contact');
            $table->dropColumn('school_member');
            $table->dropColumn('school_year');
        });
    }
}

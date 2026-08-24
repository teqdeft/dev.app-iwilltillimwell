<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApiColumnsToConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->integer('consultationId')->nullable()->after('userId');
            $table->integer('stateid')->nullable()->after('consultationId');
            $table->string('consultationTypeName')->nullable()->after('stateid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropColumn('consultationId');
            $table->dropColumn('stateid');
            $table->dropColumn('consultationTypeName');
        });
    }
}

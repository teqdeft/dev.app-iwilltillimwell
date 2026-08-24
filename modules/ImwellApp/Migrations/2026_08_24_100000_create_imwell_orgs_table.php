<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * ImWell App module - organizations.
 *
 * Intentionally a NEW table rather than an extension of `companies`:
 * `companies` is wired into legacy corporate code paths (menu_access(),
 * HealthRecordMiddleware) that are currently disabled, and reusing it would
 * couple this module to that dead logic.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('imwell_orgs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->longText('description')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('primary_color', 20)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('imwell_orgs');
    }
};

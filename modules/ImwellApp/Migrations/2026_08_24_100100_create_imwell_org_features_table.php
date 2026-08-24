<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('imwell_org_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('imwell_org_id');
            $table->string('feature_key', 64);
            $table->boolean('enabled')->default(0);
            $table->timestamps();

            $table->unique(['imwell_org_id', 'feature_key'], 'imwell_org_feature_unique');
            $table->index('imwell_org_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('imwell_org_features');
    }
};

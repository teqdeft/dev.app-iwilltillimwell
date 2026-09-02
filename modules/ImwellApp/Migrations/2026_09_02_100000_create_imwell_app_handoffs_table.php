<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * One-time sign-in tickets that carry a member from imwell.app into the main
 * application.
 *
 * The two sites are different root domains, so the session created when a
 * member activates on imwell.app does not exist here. Rather than ask for the
 * password a second time, activation issues a ticket; "Continue to the app"
 * spends it at /org/{slug}/continue/{ticket}, which signs the member in on
 * this domain and deletes it.
 *
 * Separate from imwell_org_activations on purpose: activation tokens live for
 * days and are emailed, these live for minutes and travel in a URL.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('imwell_app_handoffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('imwell_org_id');
            $table->string('token', 64)->unique();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('imwell_app_handoffs');
    }
};

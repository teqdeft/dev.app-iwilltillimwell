<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds the org relationship to users.
 *
 * NULLABLE + index only (deliberately no FK constraint): every existing query
 * ignores this column and existing rows stay NULL, so no current behaviour
 * changes. A FK on the live `users` table would risk migration failure and
 * cascade surprises for zero benefit here - integrity is enforced in code.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'imwell_org_id')) {
                $table->unsignedBigInteger('imwell_org_id')->nullable();
                $table->index('imwell_org_id', 'users_imwell_org_id_index');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'imwell_org_id')) {
                $table->dropIndex('users_imwell_org_id_index');
                $table->dropColumn('imwell_org_id');
            }
        });
    }
};

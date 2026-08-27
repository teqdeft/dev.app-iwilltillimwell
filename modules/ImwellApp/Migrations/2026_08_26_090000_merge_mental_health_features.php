<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Folds the separate mental health switches into a single 'mental_health' one.
 *
 * Before: counseling, journal, mood_tracking, cbt, safety_plan, affirmations
 * After:  mental_health
 *
 * An organization that had ANY of the old switches on gets 'mental_health' on,
 * so nothing an admin had already enabled is silently lost.
 */
return new class extends Migration
{
    const OLD_KEYS = [
        'counseling', 'journal', 'mood_tracking', 'cbt', 'safety_plan', 'affirmations',
    ];

    const NEW_KEY = 'mental_health';

    public function up()
    {
        if (! Schema::hasTable('imwell_org_features')) {
            return;
        }

        $orgIds = DB::table('imwell_org_features')
            ->whereIn('feature_key', self::OLD_KEYS)
            ->distinct()
            ->pluck('imwell_org_id');

        foreach ($orgIds as $orgId) {
            $enabled = DB::table('imwell_org_features')
                ->where('imwell_org_id', $orgId)
                ->whereIn('feature_key', self::OLD_KEYS)
                ->where('enabled', 1)
                ->exists();

            $existing = DB::table('imwell_org_features')
                ->where('imwell_org_id', $orgId)
                ->where('feature_key', self::NEW_KEY)
                ->first();

            if ($existing) {
                // Never downgrade a switch an admin has already turned on.
                if ($enabled && ! $existing->enabled) {
                    DB::table('imwell_org_features')
                        ->where('id', $existing->id)
                        ->update(['enabled' => 1, 'updated_at' => now()]);
                }
            } else {
                DB::table('imwell_org_features')->insert([
                    'imwell_org_id' => $orgId,
                    'feature_key'   => self::NEW_KEY,
                    'enabled'       => $enabled ? 1 : 0,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }

        DB::table('imwell_org_features')->whereIn('feature_key', self::OLD_KEYS)->delete();
    }

    /**
     * Fans the single switch back out to the six original keys, so a rollback
     * leaves those organizations working as they did before.
     */
    public function down()
    {
        if (! Schema::hasTable('imwell_org_features')) {
            return;
        }

        $rows = DB::table('imwell_org_features')
            ->where('feature_key', self::NEW_KEY)
            ->get();

        foreach ($rows as $row) {
            foreach (self::OLD_KEYS as $key) {
                $exists = DB::table('imwell_org_features')
                    ->where('imwell_org_id', $row->imwell_org_id)
                    ->where('feature_key', $key)
                    ->exists();

                if (! $exists) {
                    DB::table('imwell_org_features')->insert([
                        'imwell_org_id' => $row->imwell_org_id,
                        'feature_key'   => $key,
                        'enabled'       => $row->enabled ? 1 : 0,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }
            }
        }

        DB::table('imwell_org_features')->where('feature_key', self::NEW_KEY)->delete();
    }
};

<?php

namespace Modules\ImwellApp\Support;

use Modules\ImwellApp\Models\ImwellOrg;

/**
 * Single source of truth for feature lookups.
 *
 * Deliberately NOT reusing the legacy menu_access() helper - that helper has
 * its body commented out and unconditionally returns true, so it cannot gate
 * anything.
 */
class Features
{
    public static function all()
    {
        return config('imwellapp.pages', []);
    }

    /** Features an admin can toggle (excludes always-on entries). */
    public static function toggleable()
    {
        return array_values(array_filter(static::all(), function ($f) {
            return empty($f['always']);
        }));
    }

    public static function keys()
    {
        return array_column(static::all(), 'key');
    }

    /** Resolve a URL segment (e.g. "medical-care") to its feature definition. */
    public static function byPage($page)
    {
        foreach (static::all() as $feature) {
            if (($feature['page'] ?? null) === $page) {
                return $feature;
            }
        }

        return null;
    }

    public static function byKey($key)
    {
        foreach (static::all() as $feature) {
            if ($feature['key'] === $key) {
                return $feature;
            }
        }

        return null;
    }

    /** Nav entries an org member is allowed to see. */
    public static function navFor(ImwellOrg $org)
    {
        $enabled = $org->enabledFeatureKeys();

        return array_values(array_filter(static::all(), function ($f) use ($enabled) {
            return ! empty($f['always']) || in_array($f['key'], $enabled, true);
        }));
    }
}

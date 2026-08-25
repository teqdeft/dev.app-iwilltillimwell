<?php

namespace Modules\ImwellApp\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    /** Cached per request so the sidebar does not re-query for every item. */
    protected static $cachedOrg = false;
    protected static $cachedKeys = null;

    public static function all()
    {
        return config('imwellapp.pages', []);
    }

    public static function toggleable()
    {
        return static::all();
    }

    public static function keys()
    {
        return array_column(static::all(), 'key');
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

    /**
     * Resolve a request to the feature that owns it.
     * Returns null when the path belongs to no feature (always allowed).
     */
    public static function forRequest(Request $request)
    {
        foreach ((array) config('imwellapp.always_allowed', []) as $pattern) {
            if ($request->is($pattern)) {
                return null;
            }
        }

        foreach (static::all() as $feature) {
            foreach ((array) ($feature['paths'] ?? []) as $pattern) {
                if ($request->is($pattern)) {
                    return $feature;
                }
            }
        }

        return null;
    }

    /**
     * The organisation of the signed-in user, or null when the user is not an
     * ImWell org member (i.e. every existing user of the app).
     */
    public static function currentOrg()
    {
        if (static::$cachedOrg !== false) {
            return static::$cachedOrg;
        }

        try {
            $user = Auth::user();
        } catch (\Throwable $e) {
            // No session guard available (console, queued mail render, ...).
            return static::$cachedOrg = null;
        }

        if (! $user || empty($user->imwell_org_id)) {
            return static::$cachedOrg = null;
        }

        return static::$cachedOrg = ImwellOrg::find($user->imwell_org_id);
    }

    /** Enabled feature keys for the current user's org (cached per request). */
    public static function currentKeys()
    {
        if (static::$cachedKeys !== null) {
            return static::$cachedKeys;
        }

        $org = static::currentOrg();

        return static::$cachedKeys = $org ? $org->enabledFeatureKeys() : [];
    }

    /**
     * Used by the sidebar and any view that wants to hide a menu entry.
     *
     * Returns TRUE for everyone who is not an ImWell org member, so existing
     * users and existing screens behave exactly as before.
     */
    public static function can($featureKey)
    {
        if (! static::currentOrg()) {
            return true;
        }

        return in_array($featureKey, static::currentKeys(), true);
    }

    /** Nav entries an org member is allowed to see. */
    public static function navFor(ImwellOrg $org)
    {
        $enabled = $org->enabledFeatureKeys();

        return array_values(array_filter(static::all(), function ($f) use ($enabled) {
            return in_array($f['key'], $enabled, true);
        }));
    }

    public static function flush()
    {
        static::$cachedOrg = false;
        static::$cachedKeys = null;
    }
}

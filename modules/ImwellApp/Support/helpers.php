<?php

use Modules\ImwellApp\Support\Features;

/**
 * View helpers for the ImWell App module.
 *
 * Loaded by ModuleProvider, so no change to composer.json autoload files.
 */

if (! function_exists('org_can')) {
    /**
     * Should this feature be visible to the current user?
     *
     * Returns TRUE for every user who is not an ImWell org member, so wrapping
     * an existing menu item in @if(org_can('x')) does not change what any
     * current user sees.
     */
    function org_can($featureKey)
    {
        return Features::can($featureKey);
    }
}

if (! function_exists('org_current')) {
    /** The signed-in user's organisation, or null. */
    function org_current()
    {
        return Features::currentOrg();
    }
}

if (! function_exists('org_logo')) {
    /**
     * Organisation logo when the current user belongs to one, otherwise the
     * app logo passed in as the fallback.
     */
    function org_logo($fallbackAsset = null)
    {
        $org = Features::currentOrg();

        if ($org && $org->logoUrl()) {
            return $org->logoUrl();
        }

        return $fallbackAsset;
    }
}

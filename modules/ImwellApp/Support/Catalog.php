<?php

namespace Modules\ImwellApp\Support;

use Modules\ImwellApp\Models\ImwellOrg;

/**
 * Turns an organization and its enabled features into the plain arrays
 * imwell.app renders.
 *
 * It lives here, not on imwell.app, so the labels and descriptions a member
 * reads on the second domain come from the same Config/features.php that
 * decides what they can actually open in the application. Add a feature there
 * and it appears on imwell.app with no change to that site.
 */
class Catalog
{
    public static function org(ImwellOrg $org)
    {
        return [
            'id'            => (int) $org->id,
            'name'          => $org->name,
            'slug'          => $org->slug,
            'description'   => $org->description,
            'logo_url'      => $org->logoUrl(),
            'primary_color' => $org->primary_color ?: '#994c8d',
            'contact_email' => $org->contact_email,
            'contact_phone' => $org->contact_phone,
            'app_url'       => $org->url(),
        ];
    }

    /**
     * The services this organization switched on, in catalogue order, each
     * with the copy shown on the member's dashboard.
     *
     * Anything marked 'hidden' is withheld from organizations altogether, so a
     * stale imwell_org_features row cannot advertise a service the member
     * would then be blocked from opening.
     */
    public static function services(ImwellOrg $org)
    {
        $enabled = $org->enabledFeatureKeys();
        $out     = [];

        foreach (Features::all() as $feature) {
            if (! empty($feature['hidden'])) {
                continue;
            }

            if (! in_array($feature['key'], $enabled, true)) {
                continue;
            }

            $out[] = [
                'key'     => $feature['key'],
                'label'   => $feature['label'],
                'blurb'   => $feature['blurb'] ?? '',
                'details' => array_values((array) ($feature['details'] ?? [])),
                // The first path of the feature is its entry point in the main
                // application, so the dashboard can deep-link each service.
                'path'    => static::entryPath($feature),
            ];
        }

        return $out;
    }

    /** First non-wildcard path of a feature - where the member should land. */
    protected static function entryPath(array $feature)
    {
        foreach ((array) ($feature['paths'] ?? []) as $path) {
            if (strpos($path, '*') === false) {
                return $path;
            }
        }

        return null;
    }
}

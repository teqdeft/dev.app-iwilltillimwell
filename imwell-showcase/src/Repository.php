<?php

namespace Showcase;

/**
 * Every query the showcase site needs, against the main application's tables.
 *
 * All of them are reads. Activation and sign in happen in the main
 * application, so this site never writes to the shared database.
 */
class Repository
{
    /**
     * The service catalogue, mirroring modules/ImwellApp/Config/features.php.
     * Kept as a plain map so the showcase site has no dependency on the main
     * application's code - only on its database.
     */
    const FEATURES = [
        'medical_care'       => ['label' => 'Medical Care',         'blurb' => 'Virtual urgent care, primary care and dermatology consultations with licensed physicians.'],
        'health_record'      => ['label' => 'Health Records & Labs','blurb' => 'Personal health records, medications, allergies, conditions and lab requests in one place.'],
        'mental_health'      => ['label' => 'Mental Health',        'blurb' => 'In-the-moment care and crisis support, therapy, moods, journaling, safety plans, thought analysis and screenings.'],
        'care_coordination'  => ['label' => 'Care Coordination',    'blurb' => 'A care coordinator to help navigate appointments, referrals and advocacy.'],
        'message_specialist' => ['label' => 'Message a Specialist', 'blurb' => 'Send a question to a specialist and get a written response.'],
        'pets'               => ['label' => 'Pet Care',             'blurb' => 'Talk to a veterinarian about your pets and keep their history.'],
    ];

    public static function organizationBySlug($slug)
    {
        return Database::selectOne(
            'SELECT * FROM imwell_orgs
              WHERE slug = ? AND status = 1 AND deleted_at IS NULL
              LIMIT 1',
            [$slug]
        );
    }

    /** Feature keys the admin switched on for this organization. */
    public static function enabledFeatureKeys($orgId)
    {
        $rows = Database::select(
            'SELECT feature_key FROM imwell_org_features
              WHERE imwell_org_id = ? AND enabled = 1',
            [$orgId]
        );

        return array_column($rows, 'feature_key');
    }

    /** Enabled features as label + blurb, in catalogue order. */
    public static function services($orgId)
    {
        $enabled = static::enabledFeatureKeys($orgId);
        $out = [];

        foreach (static::FEATURES as $key => $meta) {
            if (in_array($key, $enabled, true)) {
                $out[$key] = $meta;
            }
        }

        return $out;
    }
}

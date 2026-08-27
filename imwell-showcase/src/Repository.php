<?php

namespace Showcase;

/**
 * Every query the showcase site needs, against the main application's tables.
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

    /** Active organizations, for the directory page. */
    public static function organizations()
    {
        return Database::select(
            'SELECT id, name, slug, logo, description
               FROM imwell_orgs
              WHERE status = 1 AND deleted_at IS NULL
           ORDER BY name ASC'
        );
    }

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

    public static function memberCount($orgId)
    {
        $row = Database::selectOne(
            'SELECT COUNT(*) AS c FROM users WHERE imwell_org_id = ?',
            [$orgId]
        );

        return $row ? (int) $row['c'] : 0;
    }

    // ---------------------------------------------------------------- auth

    public static function findMemberByEmail($email, $orgId)
    {
        return Database::selectOne(
            'SELECT id, name, fname, lname, email, password, status, imwell_org_id
               FROM users
              WHERE email = ? AND imwell_org_id = ?
              LIMIT 1',
            [$email, $orgId]
        );
    }

    /** A usable (unused, unexpired) activation token for this organization. */
    public static function findActivation($token, $orgId)
    {
        return Database::selectOne(
            'SELECT a.id, a.user_id, a.expires_at, a.used_at,
                    u.email, u.fname, u.name
               FROM imwell_org_activations a
               JOIN users u ON u.id = a.user_id
              WHERE a.token = ? AND a.imwell_org_id = ?
                AND a.used_at IS NULL
                AND (a.expires_at IS NULL OR a.expires_at > NOW())
              LIMIT 1',
            [$token, $orgId]
        );
    }

    /**
     * Set the member's chosen password and consume the token.
     *
     * Deliberately does NOT grant app access (payment_status, doctor_step,
     * the sponsored subscription and so on). The main application's
     * EnforceOrgAccess middleware does that on the member's first request
     * there, so that logic lives in exactly one place.
     */
    public static function activate($activationId, $userId, $plainPassword)
    {
        $hash = password_hash($plainPassword, PASSWORD_BCRYPT, ['cost' => 12]);

        Database::statement(
            'UPDATE users SET password = ?, status = 1, updated_at = NOW() WHERE id = ?',
            [$hash, $userId]
        );

        Database::statement(
            'UPDATE imwell_org_activations SET used_at = NOW(), updated_at = NOW() WHERE id = ?',
            [$activationId]
        );

        return true;
    }
}

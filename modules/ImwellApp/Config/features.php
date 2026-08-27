<?php

/**
 * Feature registry for the ImWell App module.
 *
 * `key`      - stored in imwell_org_features.feature_key
 * `label`    - shown to the admin on the org setup screen
 * `icon`     - font-awesome class (admin toggles)
 * `paths`    - REAL application URL patterns this feature unlocks. When an org
 *              member requests a path matching one of these and the admin has
 *              NOT enabled the feature, EnforceOrgAccess sends them back to the
 *              dashboard. Patterns use Request::is() wildcard syntax.
 * `services` - service ids written into braintree_subscription.package_service_list
 *              for the organization-sponsored subscription. These drive
 *              checkServiceEnabled() on the dashboard, i.e. which tiles unlock.
 *              Legend lives in helpers.php getPackageIncludeList():
 *                1 Virtual Urgent Care     2 Message a Specialist
 *                3 Care Coordinators       4 Dermatology
 *                5 Virtual Primary Care    9 TeleVet Pet Care
 *               15 Labs                   16 Behavioral Health
 *               19 Advanced Behavioral Health (mood, journal, safety plan, CBT)
 *
 * Add a row here and it appears in the admin toggles, the member sidebar gate,
 * the real-app route gate and the sponsored subscription automatically.
 */
return [

    /*
     | Public URL of the imwell.app showcase site, without a trailing slash
     | (e.g. https://imwell.app). Set IMWELL_SHOWCASE_URL in .env.
     |
     | When set:
     |   - activation emails link to the showcase site, so members activate
     |     there and land on their organization's landing page
     |   - activating through an older main-app link still finishes on the
     |     showcase landing page
     | When empty, everything stays on the main application as before.
     */
    'showcase_url' => env('IMWELL_SHOWCASE_URL', ''),

    /*
     | Should organisation members be registered on Lyric (telemedicine)?
     |
     | OFF by default: members imported for an organisation are not added to
     | Lyric, and no Lyric session is opened for them. The consequence is that
     | Lyric-backed screens - consultations, health records, lab reports - will
     | not work for them, so only enable the Medical Care / Health Records
     | switches for an organisation once this is turned on.
     |
     | Set IMWELL_LYRIC_ENABLED=true in .env to turn it back on; the whole
     | registration path is still in Support/Lyric.php.
     */
    'lyric_enabled' => env('IMWELL_LYRIC_ENABLED', false),

    // Paths every signed-in member may always reach, whatever their org has
    // enabled (account, auth, consent, onboarding).
    'always_allowed' => [
        'dashboard', 'v1/dashboard', 'logout', 'login', 'custom-login',
        'my-account', 'my-account/*', 'update-profile', 'update-password',
        'profile-img-deleted', 'update-acknowledge', 'search-pharmacy', 'update-pharmacy',
        'org/*', 'password/*', 'general-information/*',
        'share/user/*', 'medical-care-consent', 'feels/logout',
    ],

    'pages' => [
        [
            'key' => 'medical_care', 'label' => 'Medical Care', 'icon' => 'fas fa-laptop-medical',
            'services' => [1, 4, 5],
            'paths' => [
                'consultation-type', 'consultation-type/*',
                'my-consultations', 'my-consultations/*', 'my-consultations-dashboard',
                'create-consultation', 'update-consultation/*', 'consultations/*',
                'schedule-consultation*', 'createConsultation*', 'get-doctors-list',
                'prescriptions', 'prescriptions-*', 'semaglutide',
            ],
        ],
        [
            /*
             | Withheld from organisations entirely: it does not appear on the
             | admin setup screen, org_can('health_record') is always false for
             | a member, and EnforceOrgAccess blocks the paths below even if an
             | older imwell_org_features row still says enabled.
             |
             | Health records are Lyric-backed, and Lyric registration is off
             | for org members - see imwellapp.lyric_enabled. Remove 'hidden'
             | here to bring it back.
             */
            'hidden' => true,
            'key' => 'health_record', 'label' => 'Health Records & Labs', 'icon' => 'fas fa-notes-medical',
            'services' => [15],
            'paths' => [
                'personal-record', 'medications', 'medication-allergies',
                'medical-history', 'medical-history/*', 'surgical-conditions',
                'document-manager', 'lab-report', 'lab-report-download',
                'load-personal-popup/*', 'load-history-popup/*',
                'search-medication', 'search-medication-allergy',
            ],
        ],
        [
            /*
             | One switch for the whole mental health area: the "My Mental
             | Health" cards and the "Schedule Your Consultation" column that
             | sit side by side on the dashboard.
             |
             | Replaces the earlier separate counseling / journal /
             | mood_tracking / cbt / safety_plan / affirmations switches -
             | see the 2026_08_26 migration, which turns any of those that were
             | enabled into this one.
             */
            'key' => 'mental_health', 'label' => 'Mental Health', 'icon' => 'fas fa-brain',
            'services' => [16, 19],
            'paths' => [
                // counseling / therapy
                'counseling', 'behavioral-health', 'in-the-moment-care',
                'subscribe-to-counseling', 'group-counseling', 'group-counseling/*',
                // journal
                'journal', 'journal-deleted', 'my-journal-audio',
                'view-journal-log', 'view-journal-log-post', 'view-journal-log-post-deleted',
                'voice-journal/*', 'store-save-mode-message', 'upload-audio',
                // moods
                'my-mood-feeling', 'my-mood-feeling-history', 'my-mood-feeling-history-graph',
                'my-mood-feeling-history-deleted', 'feels/mood-logs', 'what-is-mood',
                // CBT and screenings
                'cbt-therapy', 'cbt-therapy/*', 'mental-health-screening',
                'mental-health-screening/*', 'my-screening-history-graph',
                // safety plan
                'my-safety-plan', 'safety-plan', 'safety-plan/*',
                // affirmations
                'requested-affirmation', 'get-next-affirmation', 'affirmation', 'affirmation/*',
            ],
        ],
        [
            'key' => 'care_coordination', 'label' => 'Care Coordination', 'icon' => 'fas fa-hands-helping',
            'services' => [3],
            'paths' => ['care-coordination', 'healthcare-advocacy'],
        ],
        [
            'key' => 'message_specialist', 'label' => 'Message a Specialist', 'icon' => 'fas fa-envelope-open-text',
            'services' => [2],
            'paths' => ['message-a-specialist', 'message-specialist', 'postMessageReply'],
        ],
        [
            'key' => 'pets', 'label' => 'Pet Care', 'icon' => 'fas fa-paw',
            'services' => [9],
            'paths' => [
                'pets', 'pets/*', 'pet-consultations', 'pet-faq',
                'pet-schedule-save', 'pet-consultation/*',
            ],
        ],
    ],
];

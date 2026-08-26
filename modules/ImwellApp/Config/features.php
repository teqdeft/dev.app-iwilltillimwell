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
            'key' => 'counseling', 'label' => 'Counseling / Behavioral Health', 'icon' => 'fas fa-comments',
            'services' => [16],
            'paths' => [
                'counseling', 'behavioral-health', 'in-the-moment-care',
                'subscribe-to-counseling', 'group-counseling', 'group-counseling/*',
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
            'key' => 'journal', 'label' => 'Journal', 'icon' => 'fas fa-book',
            'services' => [19],
            'paths' => [
                'journal', 'journal-deleted', 'my-journal-audio',
                'view-journal-log', 'view-journal-log-post', 'view-journal-log-post-deleted',
                'voice-journal/*', 'store-save-mode-message', 'upload-audio',
            ],
        ],
        [
            'key' => 'mood_tracking', 'label' => 'Mood Tracking', 'icon' => 'fas fa-smile',
            'services' => [19],
            'paths' => [
                'my-mood-feeling', 'my-mood-feeling-history', 'my-mood-feeling-history-graph',
                'my-mood-feeling-history-deleted', 'feels/mood-logs', 'what-is-mood',
            ],
        ],
        [
            'key' => 'cbt', 'label' => 'CBT & Screenings', 'icon' => 'fas fa-brain',
            'services' => [19],
            'paths' => [
                'cbt-therapy', 'cbt-therapy/*', 'mental-health-screening',
                'mental-health-screening/*', 'my-screening-history-graph',
            ],
        ],
        [
            'key' => 'safety_plan', 'label' => 'Safety Plan', 'icon' => 'fas fa-shield-alt',
            'services' => [19],
            'paths' => ['my-safety-plan', 'safety-plan', 'safety-plan/*'],
        ],
        [
            'key' => 'affirmations', 'label' => 'Affirmations', 'icon' => 'fas fa-sun',
            'services' => [19],
            'paths' => ['requested-affirmation', 'get-next-affirmation', 'affirmation', 'affirmation/*'],
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

<?php

/**
 * Feature registry for the ImWell App module.
 *
 * `key`   - stored in imwell_org_features.feature_key
 * `label` - shown to the admin on the org setup screen
 * `icon`  - font-awesome class (admin toggles)
 * `paths` - REAL application URL patterns this feature unlocks. When an org
 *           member requests a path matching one of these and the admin has NOT
 *           enabled the feature, EnforceOrgAccess sends them back to the
 *           dashboard. Patterns use Request::is() wildcard syntax.
 *
 * Add a row here and it appears in the admin toggles, the member sidebar gate
 * and the real-app route gate automatically. Nothing else needs editing.
 */
return [

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
            'paths' => [
                'consultation-type', 'consultation-type/*',
                'my-consultations', 'my-consultations/*', 'my-consultations-dashboard',
                'create-consultation', 'update-consultation/*', 'consultations/*',
                'schedule-consultation*', 'createConsultation*', 'get-doctors-list',
                'prescriptions', 'prescriptions-*', 'semaglutide',
            ],
        ],
        [
            'key' => 'health_record', 'label' => 'Health Records', 'icon' => 'fas fa-notes-medical',
            'paths' => [
                'personal-record', 'medications', 'medication-allergies',
                'medical-history', 'medical-history/*', 'surgical-conditions',
                'document-manager', 'lab-report', 'lab-report-download',
                'load-personal-popup/*', 'load-history-popup/*',
                'search-medication', 'search-medication-allergy',
            ],
        ],
        [
            'key' => 'counseling', 'label' => 'Counseling', 'icon' => 'fas fa-comments',
            'paths' => [
                'counseling', 'behavioral-health', 'in-the-moment-care',
                'subscribe-to-counseling', 'group-counseling', 'group-counseling/*',
            ],
        ],
        [
            'key' => 'care_coordination', 'label' => 'Care Coordination', 'icon' => 'fas fa-hands-helping',
            'paths' => ['care-coordination', 'healthcare-advocacy'],
        ],
        [
            'key' => 'message_specialist', 'label' => 'Message a Specialist', 'icon' => 'fas fa-envelope-open-text',
            'paths' => ['message-a-specialist', 'message-specialist', 'postMessageReply'],
        ],
        [
            'key' => 'journal', 'label' => 'Journal', 'icon' => 'fas fa-book',
            'paths' => [
                'journal', 'journal-deleted', 'my-journal-audio',
                'view-journal-log', 'view-journal-log-post', 'view-journal-log-post-deleted',
                'voice-journal/*', 'store-save-mode-message', 'upload-audio',
            ],
        ],
        [
            'key' => 'mood_tracking', 'label' => 'Mood Tracking', 'icon' => 'fas fa-smile',
            'paths' => [
                'my-mood-feeling', 'my-mood-feeling-history', 'my-mood-feeling-history-graph',
                'my-mood-feeling-history-deleted', 'feels/mood-logs', 'what-is-mood',
            ],
        ],
        [
            'key' => 'cbt', 'label' => 'CBT & Screenings', 'icon' => 'fas fa-brain',
            'paths' => [
                'cbt-therapy', 'cbt-therapy/*', 'mental-health-screening',
                'mental-health-screening/*', 'my-screening-history-graph',
            ],
        ],
        [
            'key' => 'safety_plan', 'label' => 'Safety Plan', 'icon' => 'fas fa-shield-alt',
            'paths' => ['my-safety-plan', 'safety-plan', 'safety-plan/*'],
        ],
        [
            'key' => 'affirmations', 'label' => 'Affirmations', 'icon' => 'fas fa-sun',
            'paths' => ['requested-affirmation', 'get-next-affirmation', 'affirmation', 'affirmation/*'],
        ],
        [
            'key' => 'pets', 'label' => 'Pet Care', 'icon' => 'fas fa-paw',
            'paths' => [
                'pets', 'pets/*', 'pet-consultations', 'pet-faq',
                'pet-schedule-save', 'pet-consultation/*',
            ],
        ],
    ],
];

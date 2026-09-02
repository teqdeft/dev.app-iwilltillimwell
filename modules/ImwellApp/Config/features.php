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
     | Public URL of the imwell.app site, without a trailing slash
     | (e.g. https://imwell.app). Set IMWELL_SHOWCASE_URL in .env.
     |
     | When set:
     |   - activation emails link to imwell.app, so members choose their
     |     password there and land on their organization's dashboard there
     |   - activating through an older main-app link still finishes on that
     |     same imwell.app dashboard
     | When empty, everything stays on the main application as before.
     */
    'showcase_url' => env('IMWELL_SHOWCASE_URL', ''),

    /*
     | Shared secret the imwell.app site sends as the X-Imwell-Key header on
     | every call to /api/imwell/*. Those endpoints activate accounts, so they
     | fail CLOSED: while this is empty the whole API answers 503 and nothing
     | can be activated from imwell.app.
     |
     | Put the SAME value in IMWELL_SHOWCASE_SECRET on both sites. Generate one
     | with:  php -r "echo bin2hex(random_bytes(32));"
     */
    'showcase_secret' => env('IMWELL_SHOWCASE_SECRET', ''),

    /*
     | How long a one-time hand-off ticket stays valid, in minutes.
     |
     | imwell.app and the main application are different root domains, so a
     | session made on one is invisible to the other. After a member activates
     | on imwell.app the API returns a ticket; pressing "Continue to the app"
     | spends it at /org/{slug}/continue/{ticket} on the main application,
     | which signs them in there. Single use, and short lived because it
     | travels in a URL.
     */
    'handoff_minutes' => (int) env('IMWELL_HANDOFF_MINUTES', 30),

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
            'blurb' => 'See a licensed physician by video or phone, without an appointment.',
            'details' => [
                'Virtual urgent care, day or night',
                'Virtual primary care visits',
                'Dermatology reviews from a photo',
                'Prescriptions sent to your pharmacy',
            ],
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
            'blurb' => 'Your health history, medications and lab results kept together in one place.',
            'details' => [
                'Personal health record',
                'Medications and allergies',
                'Medical and surgical history',
                'Lab requests and results',
            ],
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
            'blurb' => 'Support when you need it, from in-the-moment help to ongoing therapy.',
            'details' => [
                'In-the-moment care and crisis support',
                'Counseling and group sessions',
                'Mood tracking and voice journaling',
                'Thought analysis (CBT) and screenings',
                'Your own safety plan and affirmations',
            ],
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
            'blurb' => 'A care coordinator who helps you get to the right place.',
            'details' => [
                'Help finding the right provider',
                'Appointments and referrals arranged',
                'Advocacy on bills and coverage',
            ],
            'paths' => ['care-coordination', 'healthcare-advocacy'],
        ],
        [
            'key' => 'message_specialist', 'label' => 'Message a Specialist', 'icon' => 'fas fa-envelope-open-text',
            'services' => [2],
            'blurb' => 'Send a question to a specialist and get a written answer back.',
            'details' => [
                'Ask about a diagnosis or a treatment',
                'A written response you can keep',
                'No appointment needed',
            ],
            'paths' => ['message-a-specialist', 'message-specialist', 'postMessageReply'],
        ],
        [
            'key' => 'pets', 'label' => 'Pet Care', 'icon' => 'fas fa-paw',
            'services' => [9],
            'blurb' => 'Talk to a veterinarian about your pet, from home.',
            'details' => [
                'Virtual veterinary consultations',
                'Advice on symptoms and behaviour',
                'A record for each of your pets',
            ],
            'paths' => [
                'pets', 'pets/*', 'pet-consultations', 'pet-faq',
                'pet-schedule-save', 'pet-consultation/*',
            ],
        ],
    ],
];

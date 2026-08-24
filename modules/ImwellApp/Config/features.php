<?php

/**
 * Feature registry for the ImWell App module.
 *
 * `key`   - stored in imwell_org_features.feature_key
 * `label` - shown to the admin on the org setup screen
 * `page`  - the /org/{slug}/{page} segment this feature unlocks (null = no page)
 * `icon`  - font-awesome class used in the member nav
 *
 * Add a row here and it appears in the admin toggles, the member nav and the
 * route gate automatically. Nothing else needs editing.
 */
return [
    'pages' => [
        [ 'key' => 'dashboard',         'label' => 'Dashboard',          'page' => 'dashboard',         'icon' => 'fas fa-chart-line',     'always' => true ],
        [ 'key' => 'medical_care',      'label' => 'Medical Care',       'page' => 'medical-care',      'icon' => 'fas fa-laptop-medical' ],
        [ 'key' => 'counseling',        'label' => 'Counseling',         'page' => 'counseling',        'icon' => 'fas fa-comments' ],
        [ 'key' => 'message_specialist','label' => 'Message a Specialist','page' => 'message-specialist','icon' => 'fas fa-envelope-open-text' ],
        [ 'key' => 'journal',           'label' => 'Journal',            'page' => 'journal',           'icon' => 'fas fa-book' ],
        [ 'key' => 'mood_tracking',     'label' => 'Mood Tracking',      'page' => 'mood',              'icon' => 'fas fa-smile' ],
        [ 'key' => 'cbt',               'label' => 'CBT Tools',          'page' => 'cbt',               'icon' => 'fas fa-brain' ],
        [ 'key' => 'safety_plan',       'label' => 'Safety Plan',        'page' => 'safety-plan',       'icon' => 'fas fa-shield-alt' ],
        [ 'key' => 'affirmations',      'label' => 'Affirmations',       'page' => 'affirmations',      'icon' => 'fas fa-sun' ],
        [ 'key' => 'pets',              'label' => 'Pet Care',           'page' => 'pets',              'icon' => 'fas fa-paw' ],
        [ 'key' => 'health_record',     'label' => 'Health Records',     'page' => 'health-record',     'icon' => 'fas fa-notes-medical' ],
    ],
];

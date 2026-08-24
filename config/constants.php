<?php

return [
    'payment_complete' => 1,
    'payment_pending' => 0,
    'signup-promo' => 'WELL123GO',

    /*
     | Landing promo campaigns: when a user arrives via ?promo=CODE (e.g. from an
     | external app), the plan selection screen is restricted to ONLY the plan
     | names listed here and the code is auto-applied. Add more codes as needed.
     | Plan names must match the `name` column in the `plans` table exactly.
     */
    'landing_promo_filters' => [
               'NABV000' => ['Premium', 'Premium Family'],
    ],
    'pro_data_status' => 'inactive',
    'billing-cycle-date' => '0',
    'add_extra_days' => '0',
    'trial_days' => '0',		
    'web_privacy_link' => 'https://iwilltilimwell.com/privacy-policy',	    
    'web_term_condition' => 'https://iwilltilimwell.com/terms-conditions',	
    'plans' => [
    	'monthly_family_full_plan' => 'Monthly family full plan',
    	'monthly_self_full_plan' => 'Monthly self full plan',
    	'monthly_family_medical_plan' => 'Monthly family medical plan',
    	'monthly_self_medical_plan' => 'Monthly self Medical plan',
    	'monthly_family_counseling_plan' => 'Monthly family counseling plan',
    	'monthly_self_counseling_plan' => 'Monthly self counseling plan'
    ],
    'tel_login_url' => env('LYRIC_API_MODE', 'sandbox') === 'sandbox' 
        ? 'https://staging.getlyric.com/go/api/login' 
        : 'https://portal.getlyric.com/go/api/login',
	
    'tel_api_url' => env('LYRIC_API_MODE', 'sandbox') === 'sandbox'
        ? 'https://staging.getlyric.com/go/api/' 
        : 'https://portal.getlyric.com/go/api/',
	
	
    'tel_email' => env('LYRIC_API_MODE', 'sandbox') === 'sandbox'
        ? 'MTMIWTIW01@mytelemedicine.com'
        : 'MTMIWTIW01@mytelemedicine.com',
	
	
    'tel_password' => env('LYRIC_API_MODE', 'sandbox') === 'sandbox'
        ? 'U74AVL!0oh!Mfeu!o)0p'
        : 'lkL}ScO5v}MHLEzZVGm]',
	

     'modes' => [

        'sandbox' => [
            'login_url' => 'https://staging.getlyric.com/go/api/login',
            'api_url'   => 'https://staging.getlyric.com/go/api/',
            'email'     => 'MTMIWTIW01@mytelemedicine.com',
            'password'  => 'U74AVL!0oh!Mfeu!o)0p',
        ],

        'live' => [
            'login_url' => 'https://portal.getlyric.com/go/api/login',
            'api_url'   => 'https://portal.getlyric.com/go/api/',
            'email'     => 'MTMIWTIW01@mytelemedicine.com',
            'password'  => 'lkL}ScO5v}MHLEzZVGm]',
        ]

     ],
	
    'planid' => env('LYRIC_API_MODE', 'sandbox') === 'sandbox'
        ? 2372
        : 3114,
    'groupCode' => 'MTMIWTIW01',
    

	/*
    'tel_login_url' => 'https://portal.getlyric.com/go/api/login',
    'tel_api_url'=>'https://portal.getlyric.com/go/api/',
    'tel_email'=>'MTMIWTIW01@mytelemedicine.com',
    'tel_password'=>'lkL}ScO5v}MHLEzZVGm]',
    'planid' => 3114,
    'groupCode' => 'MTMIWTIW01',
	*/ 	
	
	'sureScriptPharmacy_id'=>'14157', 
    'age_limit' => '18',
    'start' => 0,
    'length' => 50,
    'status' => 'all',
    'height_feet' => [
        0 => '0\'', 1 => '1\'', 2 => '2\'', 3 => '3\'', 4 => '4\'', 5 => '5\'', 6 => '6\'', 7 => '7\'', 8 => '8\'',
    ],
    'height_inches' => [
        0 => '0"', 1 => '1"', 2 => '2"', 3 => '3"', 4 => '4"', 5 => '5"', 6 => '6"', 7 => '7"', 8 => '8"', 9 => '9"', 10 => '10"', 11 => '11"',
    ],
    'smoke' => [
        '1' => 'No','2' => 'Up to five daily','3' => 'Up to ten daily','4' => 'over 10 cigarettes daily'
    ],
    'drink' => [
        '1' => 'No','2' => 'Rarely','3' => 'Once a month','4' => 'Twice a month','5' => 'Once a week','6' => 'Twice a week', '7' => 'Three times a week', '8' => 'Daily'
    ],
    'exercise' => [
        '1' => 'No','2' => 'Rarely','3' => 'Once a month','4' => 'Twice a month','5' => 'Once a week','6' => 'Twice a week', '7' => 'Three times a week', '8' => 'Daily'
    ],
    'exercise_duration' => [
        '1' => '10 Mins','2' => '20 Mins','3' => '30 Mins','4' => '45 Mins','5' => '60 Mins','6' => 'over 1 hour'
    ],
    'blood_type' => [
        '' => 'Note Sure','1' => 'A','2' => 'B','3' => 'AB','4' => 'O'
    ],
    'marital_status' => [
        '1' => 'Single','2' => 'Married', '3' => 'Widowed'
    ],
    'user_status' => [
        '' => 'Select Status','1' => 'Active','0' => 'Inactive'
    ],
    'relationship' => [
        '' => 'Select Relationship','1' => 'Spouse','2' => 'Child', '3' => 'Other'
    ],
    'roi' => [
        '' => 'Please Choose One','PCP' => 'Visit Primary Care Physician','Urgent Care' => 'Go to Urgent Care', 'Emergency Room' => 'Go to Emergency Room', 'Nothing' => 'Nothing'
    ],
    'minor_age' => 18,
    'family_plan' => [2,4,6,8],
    'organization_plan' => [7,8],
    'allowed_dependents' => 7,
    'APP_USER' => 'user',
    'MODULENAME' => [ 'Dashboard','Users','Roles','Permission','Blogs',
              'Plans','Affiliates Counselors','Promo Codes','Group Counseling','Manage Content','Blog Categories'],



    /* emoji */

    'EMOJI' => [
        ':HAPPY:' => [
            'image' => 'emoji-css/happy.png',
            'mobile_image' => 'images/happy-imozi-svg.svg',
            'number' => 4,
            'child' => [
                ':JOYFUL:' => [
                    ':LIBERATED:' => 'LIBERATED',
                    ':ESTATIC:' => 'ESTATIC',
                    ':OTHER:' => 'OTHER',
                ],
                ':INTERESTED:' => [
                    ':AMUSED:' => 'AMUSED',
                    ':INQUISITIVE:' => 'INQUISITIVE',
                    ':OTHER:' => 'OTHER',
                ],
                ':PROUD:' => [
                    ':IMPORTANT:' => 'IMPORTANT',
                    ':CONFIDENT:' => 'CONFIDENT',
                    ':OTHER:' => 'OTHER',
                ],
                ':ACCEPTED:' => [
                    ':RESPECTED:' => 'RESPECTED',
                    ':FULFILLED:' => 'FULFILLED',
                    ':OTHER:' => 'OTHER',
                ],
                ':POWERFUL:' => [
                    ':COURAGEOUS:' => 'COURAGEOUS',
                    ':PROVOCATIVE:' => 'PROVOCATIVE',
                    ':OTHER:' => 'OTHER',
                ],
                ':PEACEFUL:' => [
                    ':HOPEFUL:' => 'HOPEFUL',
                    ':LOVING:' => 'LOVING',
                    ':OTHER:' => 'OTHER',
                ],
                ':INTIMATE:' => [
                    ':PLAYFUL:' => 'PLAYFUL',
                    ':SENSITIVE:' => 'SENSITIVE',
                    ':OTHER:' => 'OTHER',
                ],
                ':OPTIMISTIC:' => [
                    ':OPEN:' => 'OPEN',
                    ':INSPIRED:' => 'INSPIRED',
                    ':OTHER:' => 'OTHER',
                ],
                ':OTHER:' => [
                    ':OTHER:' => 'OTHER',
                ]
            ]
        ],
        /* sad  */

        ':SAD:' => [
            'image' => 'emoji-css/sad.png',
            'mobile_image' => 'images/sad-imozi-svg.svg',
            'number' => 3,
            'child' => [
                
                ':BORED:' => [
                    ':INDIFFERENT:' => 'INDIFFERENT',
                    ':APATHETIC:' => 'APATHETIC',
                    ':OTHER:' => 'OTHER',
                ],
                ':LONELY:' => [
                    ':ABANDONED:' => 'ABANDONED',
                    ':ISOLATED:' => 'ISOLATED',
                    ':OTHER:' => 'OTHER',
                ],
                ':DEPRESSED:' => [
                    ':INFERIOR:' => 'INFERIOR',
                    ':EMPTY:' => 'EMPTY',
                    ':OTHER:' => 'OTHER',
                ],
                ':DESPAIR:' => [
                    ':POWERLESS:' => 'POWERLESS',
                    ':VULNERABLE:' => 'VULNERABLE',
                    ':OTHER:' => 'OTHER',
                ],
                ':ABANDONED:' => [
                    ':VICTIMIZED:' => 'VICTIMIZED',
                    ':IGNORED:' => 'IGNORED',
                    ':OTHER:' => 'OTHER',
                ],
                ':GUILTY:' => [
                    ':REMORESFUL:' => 'REMORESFUL',
                    ':ASHAMED:' => 'ASHAMED',
                    ':OTHER:' => 'OTHER',
                ],
                ':OTHER:' => [
                    ':OTHER:' => 'OTHER',
                ]
            ]
        ],

        /* DISGUST  */

        ':DISGUST:' => [
            'image' => 'emoji-css/disgust.png',
            'mobile_image' => 'images/disgusted-imozi-svg.svg',
            'number' => 2,
            'child' => [
                ':AVOIDANCE:' => [
                    ':AVERSION:' => 'AVERSION',
                    ':HESITANT:' => 'HESITANT',
                    ':OTHER:' => 'OTHER',
                ],
                ':AWFUL:' => [
                    ':REVULSION:' => 'REVULSION',
                    ':DETESTABLE:' => 'DETESTABLE',
                    ':OTHER:' => 'OTHER',
                ],
                ':DISAPPROVAL:' => [
                    ':REVOLTED:' => 'REVOLTED',
                    ':REPUGNANT:' => 'REPUGNANT',
                    ':OTHER:' => 'OTHER',
                ],
                ':DISAPPOINTED:' => [
                    ':LOATHING:' => 'LOATHING',
                    ':JUDGMENTAL:' => 'JUDGMENTAL',
                    ':OTHER:' => 'OTHER',
                ],
                ':OTHER:' => [
                    ':OTHER:' => 'OTHER',
                ]
            ]
        ],

        /* anger  */

        ':ANGER:' => [
            'image' => 'emoji-css/angry.png',
            'mobile_image' => 'images/angry-imozi-svg.svg',
            'number' => 5,
            'child' => [
                ':CRITICAL:' => [
                    ':SARCASTIC:' => 'SARCASTIC',
                    ':SKEPTICAL:' => 'SKEPTICAL',
                    ':OTHER:' => 'OTHER',
                ],
                ':DISTANT:' => [
                    ':SUSPICIOUS:' => 'SUSPICIOUS',
                    ':WITHDRAWN:' => 'WITHDRAWN',
                    ':OTHER:' => 'OTHER',
                ],
                ':FRUSTRATED:' => [
                    ':IRRITATED:' => 'IRRITATED',
                    ':INFURIATED:' => 'INFURIATED',
                    ':OTHER:' => 'OTHER',
                ],
                ':AGGRESSIVE:' => [
                    ':PROVOKED:' => 'PROVOKED',
                    ':HOSTILE:' => 'HOSTILE',
                    ':OTHER:' => 'OTHER',
                ],
                ':MAD:' => [
                    ':FURIOUS:' => 'FURIOUS',
                    ':ENRAGED:' => 'ENRAGED',
                    ':OTHER:' => 'OTHER',
                ],
                ':HATEFUL:' => [
                    ':VIOLATED:' => 'VIOLATED',
                    ':RESENTFUL:' => 'RESENTFUL',
                    ':OTHER:' => 'OTHER',
                ],
                ':THREATENED:' => [
                    ':JEALOUS:' => 'JEALOUS',
                    ':INSECURE:' => 'INSECURE',
                    ':OTHER:' => 'OTHER',
                ],
                ':HURT:' => [
                    ':DEVASTATED:' => 'DEVASTATED',
                    ':EMBARRASSED:' => 'EMBARRASSED',
                    ':OTHER:' => 'OTHER',
                ],
                ':OTHER:' => [
                    ':OTHER:' => 'OTHER',
                ]
            ]
        ],

         /* fear  */

        ':FEAR:' => [
            'image' => 'emoji-css/fear.png',
            'mobile_image' => 'images/fearful-imozi-svg.svg',
            'number' => 6,
            'child' => [
                ':HUMILIATED:' => [
                    ':DISRESPECTED:' => 'DISRESPECTED',
                    ':RIDICULED:' => 'RIDICULED',
                    ':OTHER:' => 'OTHER',
                ],
                ':REJECTED:' => [
                    ':ALIENATED:' => 'ALIENATED',
                    ':INADEQUATE:' => 'INADEQUATE',
                    ':OTHER:' => 'OTHER',
                ],
                ':SUBMISSIVE:' => [
                    ':INSIGNIFICANT:' => 'INSIGNIFICANT',
                    ':WORTHLESS:' => 'WORTHLESS',
                    ':OTHER:' => 'OTHER',
                ],
                ':INSECURE:' => [
                    ':INFERIOR:' => 'INFERIOR',
                    ':INADEQUATE:' => 'INADEQUATE',
                    ':OTHER:' => 'OTHER',
                ],
                ':ANXIOUS:' => [
                    ':WORRIED:' => 'WORRIED',
                    ':OVERWHELMED:' => 'OVERWHELMED',
                    ':OTHER:' => 'OTHER',
                ],
                ':SCARED:' => [
                    ':FRIGHTENED:' => 'FRIGHTENED',
                    ':TERRIFIED:' => 'TERRIFIED',
                    ':OTHER:' => 'OTHER',
                ],
                ':OTHER:' => [
                    ':OTHER:' => 'OTHER',
                ]
            ]
        ],

         /* surprise  */

        ':SURPRISE:' => [
            'image' => 'emoji-css/surprise.png',
            'mobile_image' => 'images/surpriced-imozi-svg.svg',
            'number' => 1,
            'child' => [
                ':STARTLED:' => [
                    ':SHOCKED:' => 'SHOCKED',
                    ':DISMAYED:' => 'DISMAYED',
                    ':OTHER:' => 'OTHER',
                ],
                ':CONFUSED:' => [
                    ':DISILLUSIONED:' => 'DISILLUSIONED',
                    ':PERPLEXED:' => 'PERPLEXED',
                    ':OTHER:' => 'OTHER',
                ],
                ':AMAZED:' => [
                    ':ASTONISHED:' => 'ASTONISHED',
                    ':AWED:' => 'AWED',
                    ':OTHER:' => 'OTHER',
                ],
                ':EXCITED:' => [
                    ':EAGER:' => 'EAGER',
                    ':ENERGETIC:' => 'ENERGETIC',
                    ':OTHER:' => 'OTHER',
                ],
                ':OTHER:' => [
                    ':OTHER:' => 'OTHER',
                ]
            ]
        ],
    ],

    "meterContant" => [
       "long" =>    'At least 8 characters long',
       "upper" =>  'One uppercase character',
       "lower" =>   'One lowercase character',
       "number" =>  'One number',
       "special" => 'One special character',
    ],

    "awmiPricing" => [
        "Self" => [
            "35.99"
        ],
        "Self + Family" => [
            "49.99"
        ],

    ],


    'CBT_DETAILS' => [

                [
                    'distortion_id'=>'1',
                    'title' => 'All-or-Nothing Thinking',
                    'ex_heading' => "I'm a total failure.",
                    'short' => 'Also called black-and-white or polarized thinking, this is a cognitive distortion where situations are viewed in extremes—completely good or bad, success or failure—with no middle ground.',
                    'long'  => "Challenge this distortion by identifying shades of gray and brainstorming balanced alternatives to reduce perfectionism and emotional distress."
                ],

                [
                    'distortion_id'=>'2',
                    'title' => 'Emotional Reasoning',
                    'ex_heading' => "I'm in danger or will fail.",
                    'short' => 'A cognitive distortion where people treat their emotions as evidence of truth, assuming feelings reflect reality despite lacking objective proof.',
                    'long'  => "Challenge this distortion by separating feelings from facts, questioning the emotion's validity with evidence, considering alternative explanations, and testing predictions through behavior to build rational responses."
                ],

                [
                    'distortion_id'=>'3',
                    'title' => 'Fortune Telling',
                    'ex_heading' => "I'll fail this interview, even when facts are unclear.",
                    'short' => 'A cognitive distortion where someone predicts negative future outcomes without evidence, treating assumptions as certainties.',
                    'long'  => "Challenge this distortion by listing evidence for and against the prediction, reviewing past accuracy, and considering alternative outcomes to foster balanced thinking."
                ],

                [
                    'distortion_id'=>'4',
                    'title' => 'Overgeneralization',
                    'ex_heading' => "I'll always fail at interviews; no one will ever hire me.",
                    'short' => 'A cognitive distortion where a single negative event or limited evidence leads to a broad, sweeping conclusion treated as a permanent pattern, often using words like "always" or "never."',
                    'long'  => 'Challenge this distortion by examining specific counterexamples. List 3 to 5 past situations where the opposite occurred, reframe to "one rejection doesn’t predict all," and test the pattern with new evidence from actions.'
                ],

                [
                    'distortion_id'=>'5',
                    'title' => 'Mental Filter',
                    'ex_heading' => "Receiving mostly positive feedback on a work project but fixating only on one small criticism, convincing yourself the whole effort was a failure.",
                    'short' => 'Also called selective abstraction or negative filtering, this is a cognitive distortion where you focus only on negative aspects while ignoring positives—like a drop of ink darkening a glass of clear water.',
                    'long'  => "Challenge this distortion by actively balancing your view: list three specific positives, rate their importance objectively (e.g., on a 1–10 scale), and review the full picture to weaken the filter's hold."
                ],

                [
                    'distortion_id'=>'6',
                    'title' => 'Discounting the Positive',
                    'ex_heading' => "I just got lucky with the questions.",
                    'short' => 'A cognitive distortion where you dismiss or minimize your achievements, successes, or positive qualities, often attributing them to luck or external factors rather than your own efforts.',
                    'long'  => "Challenge this distortion by applying the same logic you'd use for a friend. List three specific skills or actions that led to the outcome, track repeated successes, and practice accepting praise without deflection."
                ],

                [
                    'distortion_id'=>'7',
                    'title' => 'Jumping to Conclusions',
                    'ex_heading' => "They think my idea is stupid and don’t want to work with me.",
                    'short' => 'A cognitive distortion where you assume negative outcomes or believe you know what others are thinking without sufficient evidence.',
                    'long'  => 'Challenge this distortion by asking for evidence. Consider alternative explanations (e.g., "They might be busy or distracted"), seek clarification when possible, and evaluate the likelihood of your assumption (0–100%) based on facts rather than feelings.'
                ],

                [
                    'distortion_id'=>'8',
                    'title' => 'Catastrophizing',
                    'ex_heading' => "This mistake will ruin my career; I'll get fired and never work again.",
                    'short' => 'A cognitive distortion where you exaggerate potential negative outcomes, turning minor issues into imagined disasters.',
                    'long'  => "Challenge this distortion by using a 'decatastrophizing' scale: rate the realistic probability (0–100%) of the worst-case scenario, list coping steps, and identify more likely outcomes based on past experience."
                ],

                [
                    'distortion_id'=>'9',
                    'title' => 'Should Statements',
                    'ex_heading' => "I should never make mistakes at work.",
                    'short' => 'A cognitive distortion where you impose rigid and unrealistic rules using words like "should," "must," or "ought to," often leading to guilt or frustration.',
                    'long'  => 'Challenge this distortion by replacing rigid language with flexible alternatives (e.g., "I would prefer to do well, but mistakes can happen"). Focus on realistic, value-based goals instead of perfection.'
                ],

                [
                    'distortion_id'=>'10',
                    'title' => 'Labeling',
                    'ex_heading' => 'For example, making a social mistake and thinking, "I\'m a total idiot," or calling someone "a jerk" after they cut you off in traffic.',
                    'short' => 'A cognitive distortion where you reduce yourself or others to a single negative label based on one event, ignoring complexity.',
                    'long'  => 'Challenge this distortion by describing specific behaviors instead ("I made a mistake this time"), listing positive counterexamples, and focusing on growth and improvement.'
                ],

                [
                    'distortion_id'=>'11',
                    'title' => 'Personalization',
                    'ex_heading' => "It's all my fault; I must have ruined it for everyone.",
                    'short' => 'A cognitive distortion where you take excessive responsibility for events outside your control or blame yourself for others\' actions or feelings.',
                    'long'  => 'Challenge this distortion by identifying what was truly within your control, considering external factors, and focusing on constructive actions rather than self-blame.'
                ],

            ]

];

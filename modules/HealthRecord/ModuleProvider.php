<?php
namespace Modules\HealthRecord;

use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{



    public function boot(){
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
    }

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getMedicalCareMenu(){
        if( !menu_access('medical-care') ){
            return [];
        }
        return [
            'my_medical_care' => [
                'title' => 'My Medical Care',
                'position' => 1,
                'url'    => '#My-Medical-Care',
                'icon'   => '<i class="fas fa-laptop-medical menu-icon"></i>',
                'children' => [
                    '#health-Record-menu' => [
                        'title' => 'Health Record',
                        'position' => 1,
                        'url'    => '#health-Record-menu',
                        'parent' => 'my_medical_care',
                        'children' => [
                            [
                                'title' => 'Personal Health Records',
                                'position' => 1,
                                'url'    => 'personal-record',
                                'parent' => 'health-record',
                            ],
                            [
                                'title' => 'Medications',
                                'position' => 2,
                                'url'    => 'medications',
                                'parent' => 'health-record',
                            ],
                            [
                                'title' => 'Medication Allergies',
                                'position' => 3,
                                'url'    => 'medication-allergies',
                                'parent' => 'health-record',
                            ],
                            [
                                'title' => 'Medical Conditions',
                                'position' => 4,
                                'url'    => 'medical-history',
                                'parent' => 'health-record',
                            ],
                            [
                                'title' => 'Upload documents',
                                'position' => 5,
                                'url'    => 'document-manager',
                                'parent' => 'health-record',
                            ],
                        ]
                    ],
                    '#Talk-to-a-doctor' => [
                        'title' => 'Talk to a Doctor',
                        'position' => 2,
                        'url'    => '#Talk-to-a-doctor',
                        'parent' => 'talk_to_a_doctor',
                        'children' => [
                            [
                                'title' => 'Schedule a Consultation',
                                'position' => 1,
                                'url'    => 'consultation-type?action=urgentcare',
                                'parent' => 'talk_to_a_doctor',
                            ],
                            [
                                'title' => 'My Consultations',
                                'position' => 2,
                                'url'    => 'my-consultations',
                                'parent' => 'talk_to_a_doctor',
                            ]
                        ]
                    ],
                    'message-a-specialist' => [
                        'title' => 'Message a Specialist',
                        'position' => 3,
                        'url'    => 'message-a-specialist',
                        'parent' => 'message-a-specialist'
                    ],
                    'care-coordination' => [
                        'title' => 'Care Coordination',
                        'position' => 4,
                        'url'    => 'care-coordination',
                        'parent' => 'care-coordination'
                    ]
                ]
            ]
        ];
    }

}

@extends('mobile.layouts.dashboard')
@section('content')
    

   <section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">

                <div class="back">
                    <a href="{{ route('mobile-dashboard') }}" class="back-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>

                <div class="top-title">
                    <h2 class="title">Care Coordination</h2>
                </div>
                
            </div>
        </div>
   </section>

    <section class="care-cordin">
        <div class="cust-container-md">
            <div class="cordin">
                <div class="image">
                    <img src="{{ asset('assets/dashboard/assets/images/coordination.png')}}" alt="image" />
                </div>
                <div class="content">
                    <h2 class="top-title">
                        Behavioral Health Virtual Counseling
                    </h2>
                    <div class="detail-v1">
                        <p></p>
                    </div>

                    <div class="repeat-content">
                        <div class="title">
                            <p>When Life Gets Complicated, Let Us Help!</p>
                        </div>
						<?php /*	
                        <div class="contact-detail">
                            <div class="icon">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_155_1044)">
                                    <path d="M6 3V6H9" stroke="#8462A8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6 11C8.7615 11 11 8.7615 11 6C11 3.2385 8.7615 1 6 1C3.2385 1 1 3.2385 1 6C1 8.7615 3.2385 11 6 11Z" stroke="#8462A8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_155_1044">
                                    <rect width="12" height="12" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>  
                            </div>
                            <div class="value">
                                <p>Anytime</p>
                            </div>
                        </div>
                        <div class="contact-detail">
                            <div class="icon">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.5 6.5C12.5 5.30653 12.0259 4.16193 11.182 3.31802C10.3381 2.47411 9.19347 2 8 2C6.80653 2 5.66193 2.47411 4.81802 3.31802C3.97411 4.16193 3.5 5.30653 3.5 6.5C3.5 8.346 4.977 10.752 8 13.634C11.023 10.752 12.5 8.346 12.5 6.5ZM8 15C4.333 11.667 2.5 8.833 2.5 6.5C2.5 5.04131 3.07946 3.64236 4.11091 2.61091C5.14236 1.57946 6.54131 1 8 1C9.45869 1 10.8576 1.57946 11.8891 2.61091C12.9205 3.64236 13.5 5.04131 13.5 6.5C13.5 8.833 11.667 11.667 8 15Z" fill="#8462A8"/>
                                    <path d="M8 8C8.39782 8 8.77936 7.84196 9.06066 7.56066C9.34196 7.27936 9.5 6.89782 9.5 6.5C9.5 6.10218 9.34196 5.72064 9.06066 5.43934C8.77936 5.15804 8.39782 5 8 5C7.60218 5 7.22064 5.15804 6.93934 5.43934C6.65804 5.72064 6.5 6.10218 6.5 6.5C6.5 6.89782 6.65804 7.27936 6.93934 7.56066C7.22064 7.84196 7.60218 8 8 8ZM8 9C7.33696 9 6.70107 8.73661 6.23223 8.26777C5.76339 7.79893 5.5 7.16304 5.5 6.5C5.5 5.83696 5.76339 5.20107 6.23223 4.73223C6.70107 4.26339 7.33696 4 8 4C8.66304 4 9.29893 4.26339 9.76777 4.73223C10.2366 5.20107 10.5 5.83696 10.5 6.5C10.5 7.16304 10.2366 7.79893 9.76777 8.26777C9.29893 8.73661 8.66304 9 8 9Z" fill="#8462A8"/>
                                </svg>    
                            </div>
                            <div class="value">
                                <p>Anywhere</p>
                            </div>
                        </div>
                        <div class="contact-detail">
                            <div class="icon">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.939 1.7561L5.32955 1.9397C4.78689 2.10335 4.30227 2.41861 3.93274 2.84838C3.5632 3.27815 3.32413 3.80454 3.24365 4.3656C2.9912 6.1234 3.5556 8.1787 4.91645 10.5357C6.2739 12.8868 7.7682 14.4015 9.41295 15.0645C9.94142 15.2775 10.5199 15.3343 11.0797 15.2281C11.6395 15.1218 12.157 14.8571 12.5707 14.4653L13.0314 14.0284C13.3306 13.7453 13.5167 13.3632 13.5554 12.9531C13.594 12.543 13.4824 12.1328 13.2413 11.7988L12.0887 10.2008C11.9329 9.98511 11.7135 9.82355 11.4612 9.7388C11.2089 9.65404 10.9365 9.65036 10.682 9.72825L8.93865 10.2612L8.8936 10.2697C8.7015 10.2977 8.2578 9.8821 7.7053 8.925C7.1273 7.9237 7.0083 7.33805 7.16725 7.18675L8.0538 6.3597C8.37767 6.05728 8.5989 5.66117 8.68654 5.2268C8.77418 4.79244 8.72383 4.34154 8.54255 3.9372L7.97985 2.68685C7.81065 2.31059 7.51039 2.0087 7.13506 1.83745C6.75972 1.66621 6.33408 1.63729 5.939 1.7561ZM7.20635 3.03535L7.76735 4.2857C7.87622 4.52822 7.90656 4.7987 7.85414 5.05932C7.80171 5.31993 7.66913 5.55764 7.47495 5.7392L6.58585 6.5671C6.01635 7.106 6.20505 8.0257 6.97005 9.35C7.68915 10.5961 8.34535 11.2115 9.05085 11.1044L9.15625 11.0823L10.931 10.5408C11.0159 10.5148 11.1067 10.5159 11.1909 10.5441C11.275 10.5723 11.3483 10.6262 11.4002 10.6981L12.5528 12.2961C12.6735 12.4631 12.7295 12.6682 12.7102 12.8734C12.691 13.0785 12.5979 13.2697 12.4483 13.4113L11.9867 13.8482C11.6912 14.1279 11.3217 14.3168 10.9219 14.3926C10.5222 14.4684 10.1091 14.4278 9.7317 14.2757C8.2884 13.6943 6.92415 12.3114 5.6534 10.1107C4.37925 7.905 3.8633 6.02905 4.08515 4.4863C4.14258 4.08546 4.31333 3.70938 4.57732 3.40233C4.8413 3.09528 5.18751 2.87005 5.5752 2.75315L6.18465 2.56955C6.38224 2.51018 6.59468 2.52469 6.78235 2.6104C6.97003 2.6961 7.12012 2.84714 7.20465 3.03535" fill="#8462A8"/>
                                </svg>        
                            </div>
                            <div class="value">
                                <p><a href="tel:8553995547">(24/7/365)</a></p>
                            </div>
                        </div>
						*/ ?>
                    </div>

                    <div class="repeat-content">
                        <div class="title">
                            <p>ACCESS LINE</p>
                        </div>
                        <div class="repeat-detail">
                            <p>To access your dedicated health care service, please call:</p>
                        </div>
                        
                        
                        <div class="contact-detail">
                            <div class="icon">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.939 1.7561L5.32955 1.9397C4.78689 2.10335 4.30227 2.41861 3.93274 2.84838C3.5632 3.27815 3.32413 3.80454 3.24365 4.3656C2.9912 6.1234 3.5556 8.1787 4.91645 10.5357C6.2739 12.8868 7.7682 14.4015 9.41295 15.0645C9.94142 15.2775 10.5199 15.3343 11.0797 15.2281C11.6395 15.1218 12.157 14.8571 12.5707 14.4653L13.0314 14.0284C13.3306 13.7453 13.5167 13.3632 13.5554 12.9531C13.594 12.543 13.4824 12.1328 13.2413 11.7988L12.0887 10.2008C11.9329 9.98511 11.7135 9.82355 11.4612 9.7388C11.2089 9.65404 10.9365 9.65036 10.682 9.72825L8.93865 10.2612L8.8936 10.2697C8.7015 10.2977 8.2578 9.8821 7.7053 8.925C7.1273 7.9237 7.0083 7.33805 7.16725 7.18675L8.0538 6.3597C8.37767 6.05728 8.5989 5.66117 8.68654 5.2268C8.77418 4.79244 8.72383 4.34154 8.54255 3.9372L7.97985 2.68685C7.81065 2.31059 7.51039 2.0087 7.13506 1.83745C6.75972 1.66621 6.33408 1.63729 5.939 1.7561ZM7.20635 3.03535L7.76735 4.2857C7.87622 4.52822 7.90656 4.7987 7.85414 5.05932C7.80171 5.31993 7.66913 5.55764 7.47495 5.7392L6.58585 6.5671C6.01635 7.106 6.20505 8.0257 6.97005 9.35C7.68915 10.5961 8.34535 11.2115 9.05085 11.1044L9.15625 11.0823L10.931 10.5408C11.0159 10.5148 11.1067 10.5159 11.1909 10.5441C11.275 10.5723 11.3483 10.6262 11.4002 10.6981L12.5528 12.2961C12.6735 12.4631 12.7295 12.6682 12.7102 12.8734C12.691 13.0785 12.5979 13.2697 12.4483 13.4113L11.9867 13.8482C11.6912 14.1279 11.3217 14.3168 10.9219 14.3926C10.5222 14.4684 10.1091 14.4278 9.7317 14.2757C8.2884 13.6943 6.92415 12.3114 5.6534 10.1107C4.37925 7.905 3.8633 6.02905 4.08515 4.4863C4.14258 4.08546 4.31333 3.70938 4.57732 3.40233C4.8413 3.09528 5.18751 2.87005 5.5752 2.75315L6.18465 2.56955C6.38224 2.51018 6.59468 2.52469 6.78235 2.6104C6.97003 2.6961 7.12012 2.84714 7.20465 3.03535" fill="#8462A8"/>
                                </svg>        
                            </div>
                            <div class="value">
                                <p><a href="tel:8669363239">866-936-3239</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="repeat-content">
                        <div class="title">
                            <p>Understanding Your Choices.</p>
                        </div>
                        <div class="repeat-detail">
                            <p>Provide guidance for choosing a healthcare plan. Of the options presented to you, we can help you choose which is the best choice for you and your family.</p>
                        </div>
                    </div>

                    <div class="repeat-content">
                        <div class="title">
                            <p>Knowing Your Coverages.</p>
                        </div>
                        <div class="repeat-detail">
                            <p>Our team wants you to understand your medical, mental, dental, and vision benefits. We are here to answer any questions that you have.</p>
                        </div>
                    </div>

                    <div class="repeat-content">
                        <div class="title">
                            <p>Understanding Your Coverages.</p>
                        </div>
                        <div class="repeat-detail">
                            <p>We want to make sure you know the extra benefits that your coverages provide, i,e, telemedicine, disease management, Employee Assistance Program.</p>
                        </div>
                    </div>

                    <div class="repeat-content">
                        <div class="title">
                            <p>Know Your Coverage Responsibilities.</p>
                        </div>
                        <div class="repeat-detail">
                            <p>Help you make informed choices based on what your copays and deductibles are for each scenario, so you are not surprised when you utilize the services.</p>
                        </div>
                    </div>

                    <div class="repeat-content">
                        <div class="title">
                            <p>Care Coordination.</p>
                        </div>
                        <div class="repeat-detail">
                            <p>We help provide an opportunity to schedule appointments, confirm coverages, move medical records, and find the proper care for each person.</p>
                        </div>
                    </div>

                    <div class="repeat-content">
                        <div class="title">
                            <p>Billing Issues.</p>
                        </div>
                        <div class="repeat-detail">
                            <p>We have a team that can help understand, and potentially fix, any billing issues that arise. Researching and fixing bills you receive, so that you are not overpaying for the services you and your family received.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>   

    
  

    @include('mobile.includes.foooter-tab')
@endsection
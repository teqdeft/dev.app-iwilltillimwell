@extends('layouts.dashboard')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media">
                                <div class="title-heading-icon-box-cus">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold">Care Coordination</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-body">
                    <div class="all-consultations-box all-consultations-box2  p-3">
                        <div class="row">
                            <div class="col-sm-12">
                            </div>
                        </div>
                        <div class="bhhavioral-contact-wrapper  mb-4">
                            <div class="row">
                                <div class="col-sm-12">
                                </div>
                                <div class="col-xl-5">
                                    <div class="inner-behavior-img mb-3 mb-xl-0">
                                        <img src="{{ asset('assets/assets/images/PCC-Blog-920x597.png') }}"
                                            alt="call-img" />
                                    </div>
                                </div>
                                <div class="col-xl-7">
                                    <div class="inner-behavior-content">
                                        <div class="behavior-heading-title mb-3">
											<h3 class="theme-color text-capitalize">When Life Gets Complicated, Let Us Help!</h3>
                                        </div>
										<?php /*
                                        <ul>
                                            <li class="fs-18"><i class="far fa-clock"></i> Anytime</li>
                                            <li class="fs-18"><i class="fas fa-map-marker"></i> Anywhere</li>
                                            <li class="fs-18"><i class="fas fa-headset"></i> (24/7/365)</li>
                                        </ul>
										*/ ?>
                                        <hr>
                                        <div class="access-line-content-box">
                                            <div class="inner-access-line-box">
                                                <h3 class="theme-color">ACCESS LINE</h3>
                                                <p class="fs-18 mt-2">To access your dedicated health care service, please call:</p>
                                                <h2 class="py-2 mt-3"><a href="tel:+866-936-3239"><i
                                                        class="fas fa-mobile-alt"></i> 866-936-3239</a></h2>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clinical-service-content-box mb-4">
                            <div class="inner-clinical-service-content-box">
                                <h3 class="theme-color">Understanding Your Choices</h3>
                                <p class="fs-18">Provide guidance for choosing a healthcare plan. Of the options
                                    presented to you, we can help you choose which is the best choice for you and your
                                    family.</p>
                            </div>

                        </div>
                        <div class="clinical-service-content-box mb-4">
                            <div class="inner-clinical-service-content-box">
                                <h3 class="theme-color">Knowing Your Coverages</h3>
                                <p class="fs-18">Our team wants you to understand your medical, mental, dental, and
                                    vision benefits. We are here to answer any questions that you have.</p>
                            </div>

                        </div>
                        <div class="clinical-service-content-box mb-4">
                            <div class="inner-clinical-service-content-box">
                                <h3 class="theme-color">Understanding Your Coverages</h3>
                                <p class="fs-18">We want to make sure you know the extra benefits that your coverages provide, i.e., telemedicine, disease management, Employee Assistance Program. </p>
                            </div>

                        </div>
                        <div class="clinical-service-content-box mb-4">
                            <div class="inner-clinical-service-content-box">
                                <h3 class="theme-color">Know Your Coverage Responsibilities</h3>
								<p class="fs-18">We help you make informed choices based on what your copays and deductibles are for each scenario, so you are not surprised when you utilize the services.</p>
                            </div>

                        </div>
                        <div class="clinical-service-content-box mb-4">
                            <div class="inner-clinical-service-content-box">
                                <h3 class="theme-color">Care Coordination</h3>
                                <p class="fs-18">We help provide an opportunity to schedule appointments, confirm
                                    coverages, move medical records, and find the proper care for each person.</p>
                            </div>

                        </div>
                        <div class="clinical-service-content-box mb-4">
                            <div class="inner-clinical-service-content-box">
                                <h3 class="theme-color">Billing Issues</h3>
                                <p class="fs-18">We have a team that can help understand, and potentially fix, any
                                    billing issues that arise. Researching and fixing bills you receive, so that you are
                                    not overpaying for the services you and your family received.</p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
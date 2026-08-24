@extends("mobile.layouts.dashboard")
@section("content")
<section class="msg-special-header">
        <div class="cust-container-md">
            <div class="rec-row">
                <div class="back">

                    <a 
                    @if(!empty($data['id']))
                        href="{{ route('cbt-therapy-list') }}" 
                    @else
                    href="{{ route('mobile-dashboard') }}" 
                    @endif
                        class="back-btn">
                        
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.875 16.0417L7.33334 10.5L12.875 4.95834" stroke="#222A3D"
                                stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
                <div class="top-title">
                    <h2 class="title" style="display:none;">CBT Therapy</h2>
                    <h2 class="title">My Thought Analysis</h2>
                </div>
            </div>
        </div>
</section>

<section class="consul-my-v1 whats-mood">
    <div class="cust-container-md">
               
            <div class="thought_analysis_main step_one step" id="step-1">
                <x-cbt.cbt-steps :current-step="1" />
                @include('services.cbt.step.step1')
            </div>

            <div class="thought_analysis_main step_two d-none step"  id="step-2">
                <x-cbt.cbt-steps :current-step="2" />
                @include('services.cbt.step.step2')
            </div>


             <div class="thought_analysis_main step_three d-none step" id="step-3">
                    <x-cbt.cbt-steps :current-step="3" />
                    @include('services.cbt.step.step3')
            </div>

            <div class="thought_analysis_main step_four mt-5 d-none step" id="step-4">

                <x-cbt.cbt-steps :current-step="4" />
                @include('services.cbt.step.step4')
            
            </div>


    </div>
</section>
@include('mobile.includes.foooter-tab')
@push('scripts')
@include('services.cbt.step.script')


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/css/mobile/toastr.min.css')}}" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>


@endpush

<style>
.d-none {display: none !important;}
</style>



<div class="modal fade through_description_modal" id="SeeDescriptionMore" data-bs-backdrop="true"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="SeeDescriptionMoreLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title cbt-modal-heading" id="SeeDescriptionMoreLabel">All-or-Nothing Thinking</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text">
                                                    <p class="cbt-short-text-modal"></p>
                                                </div>
                                                <div class="text">
                                                    <h5 class="cbt-modal-ex-heading"></h5>
                                                </div>
                                                <div class="text">
                                                    <p class="cbt-modal-long"></p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                
                                            </div>
        </div>
    </div>
</div>
                                
@endsection 
@extends('layouts.v1.dashboard')
@section('content')
<div class='moodContainer content-wrapper cbt-therapy-stands cbt-therapy-main'>  
    <div class="row">      
        <div class="col-md-12 grid-margin">        
            <div class="row">          
                <div class="col-12 col-xl-6 mb-4 mb-xl-0">            
                    <div class="patient-details ">              
                        <div class="media">                
                            <div class="title-heading-icon-box-cus">                  
                                    <i class="far fa-calendar-alt"></i>                
                            </div>                
                            <div class="media-body"> 
                                    <h3 class="font-weight-bold"> My Thought Analysis</h3>
                            </div>              
                        </div>           
                    </div>          
                </div>        
            </div>      
        </div>    
    </div>
    <div class="card--white full-height feels-view">
 
  
                                <!-- step one -->
                                <div class="thought_analysis_main step_one step" id="step-1">
                          
                                    <x-cbt.cbt-steps :current-step="1" />
                                    @include('services.cbt.step.step1')
                                    
                                </div>

                                <!-- step two -->
                                <div class="thought_analysis_main step_two d-none step"  id="step-2">

                                
                                    <x-cbt.cbt-steps :current-step="2" />
                                    @include('services.cbt.step.step2')

                                    
                                </div>


                                <!-- step three -->
                                <div class="thought_analysis_main step_three d-none step" id="step-3">

                                    <x-cbt.cbt-steps :current-step="3" />
                                    @include('services.cbt.step.step3')

                                </div>


                                <!-- step Four -->
                                <div class="thought_analysis_main step_four mt-5 d-none step" id="step-4">

                                    <x-cbt.cbt-steps :current-step="4" />
                                    @include('services.cbt.step.step4')
                                    

                                </div>


                                <!-- Modal -->
                                <div class="modal fade through_description_modal" id="SeeDescriptionMore" data-bs-backdrop="true"
                                    data-bs-keyboard="true" tabindex="-1" aria-labelledby="SeeDescriptionMoreLabel" aria-hidden="true">
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
                                            
                                        </div>
                                    </div>
                                </div>
    </div>
</div>   

@push('scripts')
@include('services.cbt.step.script')
@endpush
@endsection

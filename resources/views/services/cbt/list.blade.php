@extends('layouts.v1.dashboard')
@section('content')
<div class='moodContainer content-wrapper cbt-therapy-list-main'>
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
                                <h3 class="font-weight-bold"> My Thought Analysis List</h3>
                                <h6 class="font-weight-normal mb-0"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card--white full-height feels-view cbt-history-section">
        <section class="edit_cbd_thoughts">
            <div class="header_row">
                <div class="go_back">
                    <a href="{{url('cbt-therapy')}}" class="btn thought_edit_btn">
                        <span class="next_icon">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M49.9999 27.5002V32.5002H19.9999L33.7499 46.2502L30.1999 49.8002L10.3999 30.0002L30.1999 10.2002L33.7499 13.7502L19.9999 27.5002H49.9999Z"
                                    fill="black" />
                            </svg>
                        </span>
                        Go Back
                    </a>
                </div>
            </div>
            <div class="edit_cbd_row">
                @include('services.cbt.cbt-component.filter-section')
                <div class="cbt-content-list">
                    <?php /*
                           @include('services.cbt.left-section')
                           @include('services.cbt.cbt-component.right-section')
                    */ ?>
                </div>
            </div>
        </section>
        <div class="modal fade full_reflection_modal" id="FullReflection" data-bs-backdrop="true" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="full_reflectionLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('services.cbt.script-section')
@include('services.cbt.cbt-component.common-script')
@endsection
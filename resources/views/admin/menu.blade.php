@extends('admin.layouts.dashboard')
@section('title', trans('labels.edit').' '.trans('labels.user'))
@section('content')

<div class="main-panel main-panel-for-modal-page promo-code-wrapper">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media pc-media-box">
                                <div class="title-heading-icon-box-cus">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold mb-0">Iwilltilimwell</h3>
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
                    <div class="all-consultations-box  p-3">
                        <div class="cf nestable-lists">
                          <div class="dd" id="nestable">
                              {!! $menuHtml !!}
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
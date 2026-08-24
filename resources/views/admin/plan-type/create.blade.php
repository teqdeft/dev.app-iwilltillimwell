@extends('admin.layouts.dashboard')
@section('content')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
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
                                    <h3 class="font-weight-bold mb-0">Create Plans Type</h3>
                                    <a href="{{ url('admin/plan-type') }}" class="btn-custom"><i
                                            class="fas fa-chevron-left" aria-hidden="true"></i> Back</a>
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
                        <form method="post" action="{{ route('admin.plan-type.store') }}" id="planType" enctype='multipart/form-data'>
                            @csrf
                            <div class="row mb-12">
                              <div class="form-group col-sm-12">
                                  <label for="select-inc-type">Title</label>
                                  <input type="text" class="form-control" id="title" name="title"
                                      placeholder="Title" value="{{ $planType->name??old('name') }}" autocomplete="off">
                                  <input type="hidden" name="id" value="{{ $planType->id??'' }}" >
                              </div>

                              <div class="col-sm-12" style="margin-top:10px;">
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-primary mr-3" id="submit">Submit</button>
                                  </div>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

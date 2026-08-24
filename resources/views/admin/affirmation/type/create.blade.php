@extends('admin.layouts.dashboard')
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
                                    <h3 class="font-weight-bold mb-0">@if ( isset($id) )
                                        Edit @else Create
                                    @endif  Affirmation Type</h3>
                                    <a href="{{ url('admin/affirmation/type') }}" class="btn-custom"><i class="fas fa-chevron-left" aria-hidden="true">
                                    </i> Back</a>
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
                        <form method="post" action="{{ route('admin.affirmation.type.store') }}" id="affirmation-type-form">
                            @csrf
                            <div class="row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="name"> Type*</label>
                                    <input type="hidden" name="id" value="{{ $affirmation[0]->id??'' }}" >
                                    <input class="form-control" name="type" value="{{ $affirmation[0]->message??'' }}" >
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mr-3 floatRight" id="submit">Submit</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection

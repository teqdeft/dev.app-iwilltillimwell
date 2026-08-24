@extends('counsellor.layouts.dashboard')
@section('content')
<div class="main-panel main-wrapper-user user-admin-wrapper">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media d-flex align-items-center">
                                <div class="title-heading-icon-box-cus">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold mb-0">Session Details</h3>
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
                        <div class="">
                            <div id="all" class="">
                                <div class="table-responsive pt-3">
                                    <div class="tab-content pt-1 pb-0">
                                        <div id="personal-info" class=" tab-pane active">
                                            <div class="row personal-info-value-box">
                                                <div class="col-md-12 grid-margin stretch-card mb-0 ">
                                                    <div class="card theme-border-0">
                                                        <div class="card-body p-0 ">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="col-xl-12">
                                                                        <div class="inner-details-box">
                                                                            <label>Title </label>
                                                                            <h3 class="text-primary fs-20 font-weight-medium">{{ $gcd->title }} </h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <div class="inner-details-box">
                                                                            <label>Description </label>
                                                                            <h3 class="text-primary fs-20 font-weight-medium">{{ $gcd->description }}</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <div class="inner-details-box">
                                                                            <label>Minimum Number Of Users </label>
                                                                            <h3 class="text-primary fs-20 font-weight-medium">{{ $gcd->minimum_number_of_users }} </h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <div class="inner-details-box">
                                                                            <label>Maximum Number Of Users </label>
                                                                            <h3 class="text-primary fs-20 font-weight-medium">{{ $gcd->maximum_number_of_users }} </h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-12">
                                                                        <div class="inner-details-box">
                                                                            <label>Host Link</label>
                                                                            <h3 class="text-primary fs-20 font-weight-medium"><a href='{{ url($gcd->link) }}' target="_blank">Counseling Host Link Click Here</a> </h3>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xl-12">
                                                                        <div class="inner-details-box">
                                                                            <label>Registration Fee</label>
                                                                            <h3 class="text-primary fs-20 font-weight-medium"> {{ "$".$gcd->registration_fee }} </h3>
                                                                        </div>
                                                                    </div>

                                                                    @if($gcd->timeTable)
                                                                    @foreach($gcd->timeTable as $eachValue)
                                                                    <div class="col-xl-6 row">
                                                                        <div class="col-xl-12">
                                                                            <div class="inner-details-box">
                                                                                <label>Date</label>
                                                                                <h3 class="text-primary fs-20 font-weight-medium">{{ date("l mS M Y", strtotime($eachValue->date)) }} </h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-6">
                                                                            <div class="inner-details-box">
                                                                                <label>Start Time</label>
                                                                                <h3 class="text-primary fs-20 font-weight-medium">{{ date("h:i a", strtotime($eachValue->startTime)) }} </h3>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-6">
                                                                            <div class="inner-details-box">
                                                                                <label>End Time</label>
                                                                                <h3 class="text-primary fs-20 font-weight-medium">{{ date("h:i a", strtotime($eachValue->endTime)) }} </h3>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                    @endif
                                                                    <div class="col-sm-12  ">
                                                                        <button type="button" onclick="window.location='{{ url("counsellor/sessions") }}'" class="btn btn-primary mr-3">Back</button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div id="all">
                                                                        <div class="pt-3">
                                                                            <table class="table table-bordered" id="users-sessions-table" sessionid="{{ Request::segment(3) }}">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Sr No.</th>
                                                                                        <th>Name</th>
                                                                                        <th>Registration Date</th>
                                                                                        <th>Status</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
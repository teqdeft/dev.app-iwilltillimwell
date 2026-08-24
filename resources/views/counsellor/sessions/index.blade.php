@extends('counsellor.layouts.dashboard')
@section('title', 'sessions')
@section('content')

<div class="main-panel main-wrapper-user">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">

                <div class="row">
                    <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media pc-media-box">
                                <div class="title-heading-icon-box-cus">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold">Sessions</h3>
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
                                    <table class="table table-bordered user-table-box" id="cousellor-sessions-table">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Last Registration date</th>
                                                <th>Maximum No. Of Users</th>
                                                <th>Minimum No. Of Users</th>
                                                <th>Registration Fee</th>
                                                <th>Status</th>
                                                <th>Actions</th>
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
    @endsection
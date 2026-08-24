@extends('admin.layouts.dashboard')
@section('title', 'users')
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
                                    <h3 class="font-weight-bold">Group Counseling</h3>
                                    <!-- <h6 class="font-weight-normal mb-0">All Users</h6> -->
                                    @if( permission_exist('group_counseling_add',$permissions??'') )
                                    <a href="{{ route('add-form') }}" class="btn-custom"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                                    @endif
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
                                    <table class="table table-bordered user-table-box" id="group-counseling-table">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Counseler Name</th>
                                                <th>Last Registration date</th>
                                                <th>Maximum No. Of Users</th>
                                                <th>Minimum No. Of Users</th>
                                                <th>Registration Fee</th>
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

        <div class="modal fade" id="addEditCounselingModel" tabindex="-1" role="dialog" aria-labelledby="personalRecordModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content" id="addEditCounseling">



                </div>
            </div>
        </div>
    </div>
    @endsection

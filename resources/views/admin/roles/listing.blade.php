@extends('admin.layouts.dashboard')
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
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold">Roles</h3>
                                    @if( permission_exist('roles_add',$permissions??'') )
                                      <a href="{{ route('admin.roles.create') }}" class="btn-custom"><i class="fas fa-plus"></i> Create Role</a>
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
                        <div>
                            <div id="all">
                                <div class="table-responsive pt-3">
                                    <table class="table table-bordered user-table-box" id="role-table">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Name</th>
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

@extends('admin.layouts.dashboard')
@section('title', 'users')
@section('content')
<div class="main-panel main-wrapper-user">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-12 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media pc-media-box">
                                <div class="title-heading-icon-box-cus">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="media-body theme-title-box">
                                    <h3 class="font-weight-bold">{{ ($usertype == 'employee')?'Employee':'Subscriber' }}</h3>
                                    <div class="theme-btn-cont organization-btn-cont">
                                    @if( permission_exist('users_add',$permissions??'') )
                                        @if($usertype != 'subscriber')
                                            <a href="{{ route('admin.users.create') }}" class="btn-custom"><i class="fas fa-plus"></i> Create Employee</a>
                                        @endif
                                    @endif
                                    @if($usertype == 'subscriber')
                                    <div class="input-group input-daterange subscribe-top">
                                       <div class="input-group-addon"> From </div> <input type="text" class="form-control" id="min-date-range" placeholder="Start Date">
                                        <div class="input-group-addon"> To </div>
                                        <input type="text" class="form-control" id="max-date-range" placeholder="End Date">
                                    </div>
                                    @endif
                                    <div class="organization_drop_cont"> 
                                    @if($usertype == 'subscriber')
                                        <!-- <label>Organization</label> -->
                                        <select class="form-control" id="organization-filter">
                                            <option value="">Select Organization</option>
                                            @if($organization)
                                                @foreach($organization as $value)
                                                    <option value="{{ $value->name }}">{{ $value->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    @endif
                                    </div>
                                    <div class="dropdown uploadSubsSheet">
                                        <a class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Import Subscriber
                                        </a>
                                        <div class="dropdown-menu uploadSbsContainer" aria-labelledby="dropdownMenuButton">
                                           <form action ="{{ url('admin/users/import-subscriber') }}" method="POST" enctype="multipart/form-data" >
                                               @csrf
                                               <input type="file" name="uploadSheet" class="form-control" >
                                               <div class="sbsButton">
                                                   <div class='sheetType'>
                                                       <a download href="{{ asset('dummy-sheets/subscriber-import.xlsx') }}" class="removeHrefClass">Download xlsx format </a>
                                                       <a download href="{{ asset('dummy-sheets/subscriber-import.csv') }}" class="removeHrefClass">Download csv format</a>
                                                   </div>
                                                    <div class='sheetUploadButton'>
                                                        <input type="submit" class="btn btn-sm btn-primary" value="Submit" >
                                                    </div>
                                                </div>
                                           </form>
                                        </div>
                                    </div>
                                    <a href="javascript:;" class="btn-custom" id="removeSelectedOrg" style="display: none;">Clear</a>
                                    <a href="{{ route('admin.users.download', ['type' => 'csv']) }}" class="btn-custom"><i class="fas fa-download" ></i> Download CSV</a>
                                    <a href="{{ route('admin.users.download', ['type' => 'xlsx']) }}" class="btn-custom"><i class="fas fa-download" ></i> Download XLSX</a>
                                   
                                </div>
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
                            <center><img src="/assets/images/ajax-loader.gif" height ="150px" width ="150px" alt="loader image" id="show-loader"></center>
                            <div id="all" class="" style="display:none;">
                                <div class="table-responsive pt-3">
                                    <table class="table table-bordered user-table-box" id="users-table" usertype="{{ $usertype }}">
                                        <thead>
                                            <tr>
                                                @if($usertype == 'subscriber')
                                                <th></th>
                                                @endif
                                                <th>Sno.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                @if($usertype == 'subscriber')
                                                    <th>Promo Code</th>
                                                    <th>Organization</th>
                                                @endif
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!--@if($users)-->
                                            <!--@foreach ($users as $user)-->
                                            <!--<tr>-->
                                            <!--    @if($usertype == 'subscriber')-->
                                            <!--        <td></td>-->
                                            <!--    @endif-->
                                                
                                            <!--    <td>1</td>-->
                                            <!--    <td>{{ $user->name }}</td>-->
                                            <!--    <td>{{ $user->email }}</td>-->
                                            <!--    <td>{{ $user->primaryPhone }}</td>-->
                                            <!--    @if($usertype == 'subscriber')-->
                                            <!--        <td>{{ $user->promocode->code }}</td>-->
                                            <!--        <td>{{ $user->promocode->code }}</td>-->
                                            <!--    @endif-->
                                            <!--    <td> {{ date("Y-m-d", strtotime($user->created_at)) }}</td>-->
                                            <!--    <td> <span class="badge badge-success">{{ $user->status }}</span></td>-->
                                            <!--</tr>-->
                                            <!--@endforeach-->
                                            <!--@else-->
                                            <!--<tr class="no-data-row">-->
                                            <!--    <td colspan="5" rowspan="2" align="center">-->
                                            <!--        <div class="message">-->
                                            <!--            <p>You have not yet create a new!</p>-->
                                            <!--        </div>-->
                                            <!--        <div class="invoice-btns">-->
                                            <!--            <a href="{{ route('clients.create') }}" class="btn-custom"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('labels.new_client') }}</a>-->
                                            <!--        </div>-->
                                            <!--    </td>-->
                                            <!--</tr>-->
                                            <!--@endif-->
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

    <div class="modal fade" id="accessPermissionModal" tabindex="-1" role="dialog" aria-labelledby="accessPermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Access Permisson</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('admin/users/access-permission') }}" method="POST"  >
                @csrf
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @endsection
@extends('affiliate.layouts.dashboard')
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
                                    <h3 class="font-weight-bold">Enrolled Students</h3>
                                    <div class="theme-btn-cont organization-btn-cont">
                                    
                                    <div class="dropdown uploadSubsSheet">
                                        <a class="btn btn-custom dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Import Students
                                        </a>
                                        <div class="dropdown-menu uploadSbsContainer affiliateImport" aria-labelledby="dropdownMenuButton">
                                           <form action ="{{ url('affiliate/import-subscriber') }}" method="POST" enctype="multipart/form-data" >
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
                                    <!-- <a href="javascript:;" class="btn-custom" id="removeSelectedOrg" style="display: none;">Clear</a>
                                    <a href="{{ route('admin.users.download', ['type' => 'csv']) }}" class="btn-custom"><i class="fas fa-download" ></i> Download CSV</a>
                                    <a href="{{ route('admin.users.download', ['type' => 'xlsx']) }}" class="btn-custom"><i class="fas fa-download" ></i> Download XLSX</a> -->
                                   
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
                            <div id="all" class="">
                                <div class="table-responsive pt-3">
                                    <table class="table table-bordered user-table-box" id="student-table">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if($users)
                                            @foreach ($users as $user)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->primaryPhone }}</td>
                                                <td>{{ $user->status }}</td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr class="no-data-row">
                                                <td colspan="5" rowspan="2" align="center">
                                                    <div class="message">
                                                        <p>You have not yet create a new!</p>
                                                    </div>
                                                    <div class="invoice-btns">
                                                        <a href="{{ route('clients.create') }}" class="btn-custom"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('labels.new_client') }}</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
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
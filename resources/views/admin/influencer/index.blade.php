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
                                    <i class="fas fa-user-tag"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold">Affiliates / Counselors </h3>
                                    <!-- <h6 class="font-weight-normal mb-0">All Users</h6> -->
                                    @if( permission_exist('affiliates_counselors_add',$permissions??'') )
                                    <a href="{{ route('admin.influencers.create') }}" class="btn-custom"><i class="fas fa-user-tag" aria-hidden="true"></i> Create Affiliate</a>
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
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::segment(3) == '')?'active':''; }}" href="{{ url('admin/influencers') }}">Affiliates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ (Request::segment(3) == 'counsellor')?'active':''; }}" href="{{ url('admin/influencers/counsellor') }}">Counsellor</a>
                            </li>
                        </ul>
                        <div>
                            <div id="all">
                                <div class="table-responsive pt-3">
                                    <table class="table table-bordered user-table-box" id="{{ (Request::segment(3) == 'counsellor')?'counsellor':'influencers'; }}-table">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Organization</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if($influencers)
                                            @foreach ($influencers as $influencer)
                                            <tr>

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

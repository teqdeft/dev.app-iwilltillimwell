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
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold">Promo Codes</h3>
                                    <!-- <h6 class="font-weight-normal mb-0">All Users</h6> -->
                                    @if( permission_exist('promo_codes_add',$permissions??'') )
                                      <a href="{{ route('create') }}" class="btn-custom"><i class="fa fa-plus" aria-hidden="true"></i> Create Promo Code</a>
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
                                    <table class="table table-bordered user-table-box" id="promo-table">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Code</th>
                                                <th>Members <br> Discount</th>
                                                <th>Allowed<br> Members</th>
                                                <th>Affiliate<br> Name</th>
                                                <th>Affiliate<br> Commission</th>
                                                <th>Affiliate <br>Payable<br> Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @if($promo)
                                            @foreach ($promo as $promo)
                                            <tr>
                                                <!-- <td>1</td>
                                                <td>{{ $promo->code }}</td>
                                                <td>{{ $promo->valid_from }}</td>
                                                <td>{{ $promo->valid_to }}</td>
                                                <td>{{ $promo->influencer_name }}</td>
                                                <td>{{ $promo->influencer_email }}</td>
                                                <td>{{ $promo->commission_type }}</td>
                                                <td>{{ $promo->commission_amount }}</td>
                                                <td>{{ $promo->allowed_members }}</td>
                                                <td>{{ $promo->member_commission_type }}</td>
                                                <td>{{ $promo->member_commission_amount }}</td> -->
                                            </tr>
                                            @endforeach
                                                @else
                                                    <tr class="no-data-row">
                                                        <td colspan="5" rowspan="2" align="center">
                                                            <div class="message"><p>You have not yet create a new!</p></div>
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

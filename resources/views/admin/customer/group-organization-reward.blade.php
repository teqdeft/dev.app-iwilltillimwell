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
                                <div class="title-heading-icon-box-cus"><i class="fas fa-user-tag"></i></div>
                                <div class="media-body">
									<h3 class="font-weight-bold">Group Organization Reward</h3>
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
						@include('admin.customer.groupreward-add-component')
						
							
                            <div id="all">
                                <div class="table-responsive pt-3">
								
								@include('admin.customer.groupreward-add-component-table')	
                                    

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@include('admin.customer.groupreward-add-component-script')
@endsection


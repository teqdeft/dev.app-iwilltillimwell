@extends('admin.layouts.dashboard')
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
                  <h3 class="font-weight-bold mb-0">Promo Code Information</h3>
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
                                      <div class="col-xl-6">
                                        <div class="inner-details-box">
                                          <label for="exampleInputWeight">Code </label>
                                          <h3 class="text-primary fs-20 font-weight-medium">{{ $codes->code }}</h3>
                                        </div>
                                      </div>
                                      <div class="col-xl-6">
                                        <div class="inner-details-box">
                                          <label for="exampleInputWeight">Valid From</label>
                                          <h3 class="text-primary fs-20 font-weight-medium"> {{ date('d-M-Y', strtotime($codes->valid_from)) }}</h3>
                                        </div>
                                      </div>
                                      <div class="col-xl-6">
                                        <div class="inner-details-box">
                                          <label for="exampleInputWeight">Valid To</label>
                                          <h3 class="text-primary fs-20 font-weight-medium"> {{ date('d-M-Y', strtotime($codes->valid_to)) }}</h3>
                                        </div>
                                      </div>
                                      <div class="col-xl-6">
                                        <div class="inner-details-box">
                                          <label for="exampleInputWeight">Influencer Name </label>
                                          <h3 class="text-primary fs-20 font-weight-medium">{{ $codes->influencer_name }}</h3>
                                        </div>
                                      </div>
                                      <div class="col-xl-6">
                                        <div class="inner-details-box">
                                          <label for="exampleInputWeight">Influencer Email</label>
                                          <h3 class="text-primary fs-20 font-weight-medium">{{ $codes->influencer_email }}</h3>
                                        </div>
                                      </div>                                     
                                      <div class="col-xl-6">
                                        <div class="inner-details-box">
                                          <label for="exampleInputWeight">Discount Amount</label>
                                          <h3 class="text-primary fs-20 font-weight-medium">{{ $codes->influencer_discount_amount }}</h3>
                                        </div>
                                      </div> 
                                      <div class="col-xl-6">
                                        <div class="inner-details-box">
                                          <label for="exampleInputWeight">Influencer Payable Amount</label>
                                          <h3 class="text-primary fs-20 font-weight-medium">{{ $codes->influencer_payable_amount ? $codes->influencer_payable_amount : 'N/A' }}</h3>
                                        </div>
                                      </div>
                                      <div class="col-xl-6">
                                        <div class="inner-details-box">
                                          <label for="exampleInputWeight">Allowed Members </label>
                                          <h3 class="text-primary fs-20 font-weight-medium">{{ $codes->allowed_members }}</h3>
                                        </div>
                                      </div>                                     
                                      <div class="col-xl-6">
                                        <div class="inner-details-box">
                                          <label for="exampleInputWeight">Member Discount Amount</label>
                                          <h3 class="text-primary fs-20 font-weight-medium">{{ $codes->members_discount_amount }}</h3>
                                        </div>
                                      </div> 
                                      <div class="col-sm-12  ">
                                        <button type="button" onclick="window.location='{{ url("admin/promo-codes") }}'" class="btn btn-primary mr-3" >Back</button>
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
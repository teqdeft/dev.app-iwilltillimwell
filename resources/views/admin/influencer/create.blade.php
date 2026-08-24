@extends('admin.layouts.dashboard')
@section('content')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<div class="main-panel main-panel-for-modal-page promo-code-wrapper">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media pc-media-box">
                                <div class="title-heading-icon-box-cus">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold mb-0">Create Affiliate</h3>
                                    <a href="{{ url('admin/influencers') }}" class="btn-custom"><i
                                            class="fas fa-chevron-left" aria-hidden="true"></i> Back</a>
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
                        <form method="post" action="{{ route('admin.influencers.store') }}" id="influencer-form">
                            @csrf
                            <div class="row mb-4">
                              <div class="form-group col-sm-6">
                                  <label for="select-inc-type">User Type*</label>
                                  <select class="form-control" id="user-affiliate" name="user_role">
                                      <option value="">Select</option>
                                      <option value="influencer">Affiliate</option>
                                      <option value="counsellor">Counsellor</option>
                                  </select>
                              </div>
                                <div class="form-group col-sm-6">
                                    <label for="inc_email"> Email*</label>
                                    <input type="email" class="form-control" id="inc_email" name="email"
                                        placeholder="email" autocomplete="off">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inc_fname">First Name*</label>
                                    <input type="text" class="form-control" id="inc_fname" name="fname"
                                        placeholder="first name" autocomplete="off">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inc_lname">Last Name*</label>
                                    <input type="text" class="form-control" id="inc_lname" name="lname"
                                        placeholder="last name" autocomplete="off">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inc_phone">Phone*</label>
                                    <input type="text" class="form-control" id="inc_phone" name="primaryPhone"
                                        placeholder="phone" autocomplete="off">
                                </div>								
                                <div class="form-group col-sm-6">
                                    <label for="inc_phone">Password*</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="password" autocomplete="off" required>
                                </div>
                                <div class="form-group col-sm-6" id="orgType" style="display:none;">
                                    <label for="select-inc-type">Type*</label>
                                    <select class="form-control" id="select-inc-type" name="influencerType">
                                        <option value="">Select</option>
                                        <option value="1">Individual</option>
                                        <option value="2">Organization</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6 organization-inc-cnt" style="display:none">
                                    <label for="inc_organization">Organization*</label>
                                    <input type="text" class="form-control" id="inc_organization" name="organization" placeholder="organization name" autocomplete="off">
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mr-3" id="submit">Submit</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

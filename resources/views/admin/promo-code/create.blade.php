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
                                    <h3 class="font-weight-bold mb-0">Create Promo Code</h3>
                                    <a href="{{ url('admin/promo-codes') }}" class="btn-custom"><i class="fas fa-chevron-left" aria-hidden="true"></i> Back</a>
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
                        <form method="post" action="{{ route('store') }}" id="promo-code-form">
                            @csrf
                            <input type="hidden" name='id' value="{{ $promo->id??'' }}" >
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <h3>Promo Code Details</h3>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="select-promo-type">Type (Promo Code For)*</label>
                                    <select class="form-control" id="select-promo-type" name="influencerType">
                                        <option value="">Please select promo code type</option>
                                        <option value="1" <?php 
                                            if( isset($promo->influencer_type) && 
                                                $promo->influencer_type == 1 ){
                                                echo 'selected';
                                            }
                                        ?> >Individual</option>
                                        <option value="2" <?php 
                                            if( isset($promo->influencer_type) && 
                                                $promo->influencer_type == 2 ){
                                                echo 'selected';
                                            }
                                        ?>>Organization</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="select-influencer">Select Affiliate*</label>
                                    <select class="form-control" id="select-influencer" name="influencer_id">
                                        <option value="">Please select type first</option>
                                            @foreach($users as $value)
                                                <option value="{{ $value->id }}" {{ ( isset($promo->influencer_id) && $value->id == $promo->influencer_id )?'selected':''; }} >
                                                    {{ $value->fullname }}
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="email">Code*</label>
                                    <input type="text" class="form-control" id="code" name="code" placeholder="Enter code" autocomplete="off" value="{{ $promo->code??old('code','') }}">
                                </div>								
                                <div class="form-group col-sm-6">
                                    <label for="email">Coupon Mode*</label>
                                    <select class="form-control" id="coupon_mode" name="coupon_mode">										<option value="package" {{ (old('coupon_mode', $promo->coupon_mode ?? '') == 'package') ? 'selected' : '' }}>Package</option>										<option value="holiday" {{ (old('coupon_mode', $promo->coupon_mode ?? '') == 'holiday') ? 'selected' : '' }}>Holiday Special</option>									</select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="allowed_members">Allowed Members*</label>
                                    <input type="number" class="form-control" id="allowed_members" name="allowed_members" autocomplete="off" value="{{ $promo->allowed_members??old('allowed_members','') }}">
                                </div>
                                <div class="form-group col-sm-6 from-date-cal-box">
                                    <label for="valid_from">Valid From*</label>
                                    <div class="dob-cal-box">
                                        <input type="text" class="form-control" id="valid_from" name="valid_from" placeholder="dd - mm - yyyy" onkeydown="event.preventDefault()" placeholder="Select date" autocomplete="off" readonly value="{{ $promo->valid_from??old('valid_from','') }}">
                                        <i class="far fa-calendar-alt date-icon from-date-icon"></i>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 to-date-cal-box">
                                    <label for="valid_to">Valid To*</label>
                                    <div class="dob-cal-box">
                                        <input type="text" class="form-control" id="valid_to" name="valid_to" placeholder="dd - mm - yyyy" onkeydown="event.preventDefault()" placeholder="Select date" autocomplete="off" readonly value="{{ $promo->valid_to??old('valid_to','') }}">
                                        <i class="far fa-calendar-alt date-icon to-date-icon"></i>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="member_commission_type">Discount Type*</label>
                                    <div class="d-flex w-100 align-items-center h-50">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="member_fixed" name="member_discount_type" class="custom-control-input" value="fixed" 
                                                {{ (isset($promo->member_discount_type) && $promo->member_discount_type == 'fixed')?'checked':''; }}
                                            >
                                            <label class="custom-control-label" for="member_fixed">Fixed</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="member_percentage" name="member_discount_type" class="custom-control-input" value="percentage"
                                            {{ (isset($promo->member_discount_type) && $promo->member_discount_type == 'percentage')?'checked':''; }}
                                            >
                                            <label class="custom-control-label" for="member_percentage">Percentage</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="member_amount" id="member_amount">Discount Amount*</label>
                                        <input type="number" class="form-control" id="member_amount" name="member_discount_amount" autocomplete="off"
                                         value="{{ $promo->member_discount_amount??old('member_discount_amount','') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <h3>Affiliate Commission</h3>
                                </div>
                                <div class="col-sm-6">
                                    <label for="commission_type">Commission Type*</label>
                                    <div class="d-flex w-100 align-items-center h-50">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="fixed" name="influencer_commission_type" class="custom-control-input" value="fixed" 
                                            {{ (isset($promo->influencer_commission_type) && $promo->influencer_commission_type == 'fixed')?'checked':''; }} >
                                            <label class="custom-control-label" for="fixed">Fixed</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="percentage" name="influencer_commission_type" class="custom-control-input" value="percentage"
                                            {{ (isset($promo->influencer_commission_type) && $promo->influencer_commission_type == 'percentage')?'checked':''; }} >
                                            <label class="custom-control-label" for="percentage">Percentage </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="commission_amount">Commission Amount*</label>
                                    <input type="number" class="form-control" id="discount_amount" name="influencer_commission_amount" autocomplete="off"  value="{{ $promo->influencer_commission_amount??old('influencer_commission_amount','') }}">
                                </div>
                                @php $style = "display:none;" @endphp
                                @if( isset($promo->influencer_type) && $promo->influencer_type == 2 )
                                    @php $style = "display:block;" @endphp
                                @endif

                                <div class="form-group col-sm-6 commission-from-date-cal-box" style="{{ $style }}">
                                    <label for="commission_from">Commission From*</label>
                                    <div class="dob-cal-box">
                                        <input type="text" class="form-control" id="commission_from" name="commission_from" value="{{ $promo->commission_from??'' }}" placeholder="dd - mm - yyyy" onkeydown="event.preventDefault()" placeholder="Select date" autocomplete="off" readonly>
                                        <i class="far fa-calendar-alt date-icon commission-from-date-icon"></i>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 commission-to-date-cal-box" style="{{ $style }}" >
                                    <label for="commission_to">Commission To*</label>
                                    <div class="dob-cal-box">
                                        <input type="text" class="form-control" id="commission_to" name="commission_to" value="{{ $promo->commission_to??'' }}" placeholder="dd - mm - yyyy" onkeydown="event.preventDefault()" placeholder="Select date" autocomplete="off" readonly>
                                        <i class="far fa-calendar-alt date-icon commission-to-date-icon"></i>
                                    </div>
                                </div>
                            </div>


                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mr-3" id="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
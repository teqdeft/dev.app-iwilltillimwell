@extends('admin.layouts.dashboard')
@section('content')
<style>
   .from-date-cal-box .delete-date-time i {
      padding-right: 5px;
   }
</style>
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
                           <h3 class="font-weight-bold mb-0">Create New Group Counseling</h3>
                           <a href="{{ url('admin/group-counseling') }}" class="btn-custom"><i class="fas fa-chevron-left" aria-hidden="true"></i> Back</a>
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
                  <form method="post" action="{{ route('create-session') }}" id="counseling-add-edit-form">
                     @csrf
                     <input type="hidden" name="define_user_time_zone"  />
                     <div class="row mb-4">
                        <div class="col-sm-12">
                           <h3>Group Counseling Details</h3>
                        </div>
                        <div class="form-group col-sm-6">
                           <label for="title">Title*</label>
                           <input type="text" class="form-control" value="{{ isset($gcd)?$gcd->title:''}}" id="title" name="title" placeholder="Enter Title" autocomplete="off">
                           <input type="hidden" class="form-control" value="{{ isset($gcd)?$gcd->id:''}}" id="counseling_id" name="counseling_id">
                           <input type="hidden" class="form-control" value="{{ $type }}" id="type" name="type">
                        </div>
                        <div class="form-group col-sm-6">
                           <label for="description">Description*</label>
                           <input type="text" class="form-control" value="{{ isset($gcd)?$gcd->description:''}}" id="description" name="description" autocomplete="off" placeholder="Enter Description">
                        </div>
                        <div class="form-group col-sm-6">
                           <label for="minimum_number_of_users">Minimum Number Of Users*</label>
                           <input type="number" class="form-control" value="{{ isset($gcd)?$gcd->minimum_number_of_users:''}}" id="minimum_number_of_users" name="minimum_number_of_users" autocomplete="off" placeholder="Minimum Number Of Users">
                        </div>
                        <div class="form-group col-sm-6">
                           <label for="maximum_number_of_users">Maximum Number Of Users*</label>
                           <input type="number" class="form-control" value="{{ isset($gcd)?$gcd->maximum_number_of_users:''}}" id="maximum_number_of_users" name="maximum_number_of_users" autocomplete="off" placeholder="Maximum Number Of Users">
                        </div>
                        <div class="form-group col-sm-6">
                           <label for="counseler_name">Select Counseler*</label>
                           <select id="counseler_id" name="counseler_id" autocomplete="off" placeholder="Select Counseler" class="form-control">
                              @foreach($users as $eachUser)
                              <option value="{{$eachUser->id}}" selected="{{ isset($gcd) && $gcd->user_id == $eachUser->id ?true:false}}">{{ $eachUser->fname.' '.$eachUser->fname}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="registration_fee">Registration Fee*</label>
                              <input type="text" class="form-control" value="{{ isset($gcd)?$gcd->registration_fee:''}}" id="registration_fee" name="registration_fee" autocomplete="off" placeholder="Registration Fee">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <label for="registration_fee">Last Date Of Registration*</label>
                              <input type="text" class="form-control last_registration_date" value="{{ isset($gcd)?$gcd->last_registration_date:''}}" id="last_registration_date" name="last_registration_date" autocomplete="off" placeholder="Last Date Of Registration">
                           </div>
                        </div>
                        <div class="col-sm-12" id="date-time-section1">
                        </div>

                        @if(isset($gcd))
                        <div class="col-sm-12" id="date-time-section">
                           @foreach($gcd->timeTable as $eachrow)
                           <div id="div-1" data-count="1" class="row">
                              <div class=" col-sm-3 from-date-cal-box">
                                 <label for="valid_from">Date*</label>
                                 <div class="dob-cal-box">
                                    <input type="text" disabled class="form-control conference_day" value="{{ isset($eachrow)?$eachrow->date:''}}" autocomplete="off">
                                    <i class="far fa-calendar-alt date-icon from-date-icon"></i>
                                 </div>
                              </div>
                              <div class=" col-sm-3 from-date-cal-box">
                                 <label for="valid_from">Start Time*</label>
                                 <div class="dob-cal-box">
                                    <input type="text" disabled class="form-control conferene_start_time" value="{{ isset($eachrow)?date('h:m A',strtotime($eachrow->startTime)):''}}" placeholder="Select date">
                                    <i class="far fa-calendar-alt date-icon from-date-icon"></i>
                                 </div>
                              </div>
                              <div class=" col-sm-3 from-date-cal-box">
                                 <label for="valid_from">End Time*</label>
                                 <div class="dob-cal-box">
                                    <input type="text" disabled class="form-control conferene_end_time" value="{{ isset($eachrow)?date('h:m A',strtotime($eachrow->endTime)):''}}" placeholder="Select date">
                                    <i class="far fa-calendar-alt date-icon from-date-icon"></i>
                                 </div>
                              </div>

                           </div>
                           @endforeach
                        </div>
                        @endif

                        @if(!isset($gcd))
                        <div class="col-sm-12" id="date-time-section">
                           <div id="div-1" data-count="1" class="row">
                              <div class=" col-sm-3 from-date-cal-box">
                                 <label for="valid_from">Date*</label>
                                 <div class="dob-cal-box">
                                    <input type="text" class="form-control conference_day" id="conference_day" name="day[]" placeholder="dd - mm - yyyy" onkeydown="event.preventDefault()" placeholder="Select date" autocomplete="off">
                                    <i class="far fa-calendar-alt date-icon from-date-icon"></i>
                                 </div>
                              </div>
                              <div class=" col-sm-3 from-date-cal-box">
                                 <label for="valid_from">Start Time*</label>
                                 <div class="dob-cal-box">
                                    <input type="text" class="form-control conferene_start_time_mk" id="conferene_start_time_mk" name="start_time[]" placeholder="dd - mm - yyyy" onkeydown="event.preventDefault()" placeholder="Select date">
                                    <i class="far fa-calendar-alt date-icon from-date-icon"></i>
                                 </div>
                              </div>
                              <div class=" col-sm-3 from-date-cal-box">
                                 <label for="valid_from">End Time*</label>
                                 <div class="dob-cal-box">
                                    <input type="text" class="form-control conferene_end_time_mk" id="conferene_end_time_mk" name="end_time[]" placeholder="dd - mm - yyyy" onkeydown="event.preventDefault()" placeholder="Select date">
                                    <i class="far fa-calendar-alt date-icon from-date-icon"></i>
                                 </div>
                              </div>
                              <div class=" col-sm-3 from-date-cal-box">
                                 <button class="btn btn-success mr-3 add-new-day" id="submit"><i class="fas fa-plus"></i> Add </button>

                              </div>
                           </div>
                        </div>

                        @endif

                        <div class="col-sm-12 mt-3">
                           <div class="form-group">
                              <button type="submit" class="btn btn-primary mr-10" id="submit">Submit</button>
                           </div>
                        </div>

                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
document.querySelector('input[name=define_user_time_zone]').value = Intl.DateTimeFormat().resolvedOptions().timeZone;
</script>
@endsection
@extends('layouts.dashboard')
@section('content')

<div class="main-panel">
   <div class="content-wrapper">
      <div class="row">
         <div class="col-md-12 grid-margin top-header-page">
            <div class="row">
               <div class="col-12 col-xl-6 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Personal Health Records</h3>
                  <h6 class="font-weight-normal mb-0">Your Personalized Health Portal</h6>
               </div>
            </div>
         </div>
      </div>
      <div class="main-content-box">
         <!-- <div class="row">
               <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                     <div class="card-body personal-info-card-box">
                        <h4 class="card-title">Add Personal Information</h4>
                        <form class="forms-sample row" method="post" action="{{ route('update.personal.info', $user->id) }}" id="personl-record-form">
                           {{ csrf_field() }}
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="exampleSelectGender">Height</label>
                                 <div class="row">
                                    <div class="col">
                                       <?php $height_feet = Config::get('constants.height_feet'); ?>
                                       <select class="form-control theme-select" name="heightFeet">
                                          @foreach ($height_feet as $key => $feet)
                                          <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->heightFeet) }}>{{ $feet }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="col">
                                       <?php $height_inches = Config::get('constants.height_inches'); ?>
                                       <select class="form-control theme-select" name="heightInches">
                                          @foreach ($height_inches as $key => $inches)
                                          <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->heightInches) }}>{{ $inches }}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail3">Do you smoke?</label>
                                 <?php $smokes = Config::get('constants.smoke'); ?>
                                 <select class="form-control theme-select" name="smokingHabits">
                                    @foreach ($smokes as $key => $smoke)
                                    <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->smokingHabits) }}>{{ $smoke }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="exampleInputWeight">Weight(lbs)</label>
                                 <input type="text" class="form-control" id="exampleInputWeight" name="weight" placeholder="Weight" value="{{ @$user_details->weight }}">
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail3">Do you Drink?</label>
                                 <?php $drinks = Config::get('constants.drink'); ?>
                                 <select class="form-control theme-select" name="drinkingHabits">
                                    @foreach ($drinks as $key => $drink)
                                    <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->drinkingHabits) }}>{{ $drink }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail3">Blood Type</label>
                                 <?php $blood_types = Config::get('constants.blood_type'); ?>
                                 <select class="form-control theme-select" name="bloodType">
                                    @foreach ($blood_types as $key => $blood_type)
                                    <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->bloodType) }}>{{ $blood_type }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail3">Do you exercise?</label>
                                 <?php $exercises = Config::get('constants.exercise'); ?>
                                 <select class="form-control theme-select" name="exerciseHabits">
                                    @foreach ($exercises as $key => $exercise)
                                    <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->exerciseHabits) }}>{{ $exercise }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail3">Blood Pressure</label>
                                 <div class="d-flex">
                                    <div>
                                       <input type="text" class="form-control" id="exampleInputWeight" name="bloodPressureSystolic"  placeholder="SYS" value="{{ @$user_details->bloodPressureSystolic }}">
                                    </div>
                                    <div class="slash-box mx-3 d-flex align-items-center">
                                       <i class="fas fa-slash" ></i>
                                    </div>
                                    <div>
                                       <input type="text" class="form-control" id="exampleInputWeight" name="bloodPressureDiastolic"  placeholder="DIA" value="{{ @$user_details->bloodPressureDiastolic }}">
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail3">Exercise for how long?</label>
                                 <?php $exercise_durations = Config::get('constants.exercise_duration'); ?>
                                 <select class="form-control theme-select" name="exerciseLength">
                                    @foreach ($exercise_durations as $key => $exercise_duration)
                                    <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->exerciseLength) }}>{{ $exercise_duration }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group">
                                 <label for="exampleInputEmail3">Marital Status</label>
                                 <?php $marital_statuses = Config::get('constants.marital_status'); ?>
                                 <select class="form-control theme-select" name="maritalStatus">
                                    @foreach ($marital_statuses as $key => $marital_status)
                                    <option value="{{ $key }}" {{ showSelectedValue($key, @$user_details->maritalStatus) }}>{{ $marital_status }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-12">
                              <input type="submit" class="btn btn-primary mr-2" value="Save" id="submitData">
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div> -->
         <div class="record-tabs-box">
            <div class="inner-record-tab-box">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12 ml-auto col-xl-12 mr-auto px-0">
                        <div class="card">
                           <div class="card-header ">
                              <div class="ip-hamburger-icon d-flex align-items-center">
                                 <ul>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                 </ul>
                                 <h5 class="fs-16 mb-0">Members</h5>
                              </div>
                              <div class="menu-tabs-cus members-detail-v1">
                                 <ul class="nav nav-tabs nav-tabs-neutral nav-tabs-responsive theme-bg-color " role="tablist" data-background-color="orange">

                                    <li class="nav-item">
                                       <a class="nav-link {{ (Request::segment(2) == '' || Request::segment(2) == Auth::user()->id ) ? 'active' : '' }}" href="{{ url('/personal-record/') }}">{{ ucfirst(Auth::user()->fname) }} {{ ucfirst(Auth::user()->lname) }}</a>
                                    </li>
                                    @if ($dependents)
                                    @foreach ($dependents as $dependent)
                                    <li class="nav-item pr-cus-link">
                                       @if ($dependent->age < Config::get('constants.minor_age'))
                                          <a class="nav-link {{ ($user->id == $dependent->id) ? 'active' : '' }}" href="{{ url('/personal-record/'.$dependent->id) }}" role="tab"> {{ ucfirst($dependent->fname) }} {{ ucfirst($dependent->lname) }}</a>
                                          @else
                                          <!-- <a class="nav-link" href="javascript:void(0)" title="This Dependent is over 18 and must manage their own records"> <span class="text-danger">*</span> {{ $dependent->name }}</a> -->
                                          @endif
                                    </li>
                                    @endforeach
                                    @endif

                                 </ul>
                              </div>

                           </div>
                           <div class="card-body add-margin-cus adds">
                              <!-- Tab panes -->
                              <div class="tab-content p-0">
                                 <div class="tab-pane {{ (Request::segment(2) == '' || Request::segment(2) == Auth::user()->id ) ? 'active' : '' }}" id="user{{ Auth::user()->id }}" role="tabpanel">
                                    <div class="row personal-info-value-box  pi-box-cus">
                                       <div class="col-md-12 grid-margin stretch-card">
                                          <div class="card theme-border-0">
                                             <div class="card-header d-flex align-items-center info-detil-v1">
                                                <h4 class=" mb-0 mr-2 lh-2"> Personal Information </h4>
                                                <a href="#0" class="btn btn-primary btn-icon-text theme-mt-0  ml-auto theme-update-btn health-modal-call nexttriggerModal" data-id="{{ @$user->id }}" data-toggle="modal" data-target="#personalRecordModalCenter">
                                                   <i class="fas fa-edit mr-1"></i>
                                                   Update
                                                </a>
                                             </div>
                                             <div class="card-body-1 personal-record-custom">
                                                <div class="row pers-rec-main v1">
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Height</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3>

                                                               @foreach ($height_feet as $key => $feet)
                                                               {{ (showSelectedValue($key, @$user_details->heightFeet)) ? $feet : '' }}
                                                               @endforeach

                                                               @foreach ($height_inches as $key => $inches)
                                                               {{ (showSelectedValue($key, @$user_details->heightInches)) ? $inches : '' }}
                                                               @endforeach
                                                            </h3>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Smoke</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3>
                                                               @foreach ($smokes as $key => $smoke)
                                                               {{ (showSelectedValue($key, @$user_details->smokingHabits)) ? $smoke : '' }}
                                                               @endforeach
                                                            </h3>
                                                         </div>
                                                      </div>
                                                   </div>


                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Weight (lbs)</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3>{{ @$user_details->weight }}</h3>
                                                         </div>
                                                      </div>
                                                   </div>


                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p class="text-muted mr-3">Drink</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3>
                                                               @foreach ($drinks as $key => $drink)
                                                               {{ (showSelectedValue($key, @$user_details->drinkingHabits)) ? $drink : '' }}
                                                               @endforeach
                                                            </h3>
                                                         </div>
                                                      </div>
                                                   </div>

                                                 
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Blood Type</p>
                                                         </div>
                                                         <div class="pre-text">
                                                              @if ( isset($user_details->bloodType) && !empty($user_details->bloodType) )
                                                                  <h3>
                                                                     @foreach ($blood_types as $key => $blood_type)
                                                                     {{ (showSelectedValue($key, @$user_details->bloodType)) ? $blood_type : '' }}
                                                                     @endforeach
                                                                  </h3>
                                                             @endif
                                                         </div>
                                                      </div>
                                                   </div>
                                                  


                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p class="text-muted mr-3">Exercise</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3>
                                                               @foreach ($exercises as $key => $exercise)
                                                               {{ (showSelectedValue($key, @$user_details->exerciseHabits)) ? $exercise : '' }}
                                                               @endforeach
                                                            </h3>
                                                         </div>
                                                      </div>
                                                   </div>

                                                  
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Blood Pressure</p>
                                                         </div>
                                                         <div class="pre-text">
                                                          @if ( isset($user_details->bloodPressureSystolic) && !empty($user_details->bloodPressureSystolic) )
                                                            <h3><span class="bp-val-sys"> {{ @$user_details->bloodPressureSystolic }} </span> / <span class="bp-val-dia">{{ @$user_details->bloodPressureDiastolic }} </span></h3>
                                                          @endif
                                                         
                                                         </div>
                                                      </div>
                                                   </div>
                                                  
                                                  
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Exercise for how long</p>
                                                         </div>
                                                         <div class="pre-text">
                                                          @if ( isset($user_details->exerciseLength) && !empty($user_details->exerciseLength) )
                                                            <h3>
                                                               @foreach ($exercise_durations as $key => $exercise_duration)
                                                               {{ (showSelectedValue($key, @$user_details->exerciseLength)) ? $exercise_duration : '' }}
                                                               @endforeach
                                                            </h3>
                                                          @endif     
                                                         </div>
                                                      </div>
                                                   </div>
                                                   
                                                   
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Marital Status</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            @if ( isset($user_details->maritalStatus) && !empty($user_details->maritalStatus) )
                                                            <h3>
                                                               @foreach ($marital_statuses as $key => $marital_status)
                                                               {{ (showSelectedValue($key, @$user_details->maritalStatus)) ? $marital_status : '' }}
                                                               @endforeach
                                                            </h3>
                                                            @endif
                                                            
                                                         </div>
                                                      </div>
                                                   </div>
                                                   

                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 @if ($dependents)
                                 @foreach ($dependents as $dependent)
                                 @php $user_details = $dependent->user_details; @endphp
                                 <div class="tab-pane {{ ($user->id == $dependent->id) ? 'active' : '' }}" id="user{{ $dependent->id }}" role="tabpanel">
                                    <div class="row personal-info-value-box">
                                       <div class="col-md-12 grid-margin stretch-card">
                                          <div class="card theme-border-0">
                                             <div class="card-header d-flex align-items-center info-detil-v1">
                                                <h4 class=" mb-0 mr-2 lh-2"> Personal Information </h4>
                                                <a href="#0" class="btn btn-primary btn-icon-text theme-mt-0  ml-auto theme-update-btn health-modal-call" data-id="{{ @$dependent->id }}" data-toggle="modal" data-target="#personalRecordModalCenter">
                                                   <i class="fas fa-edit mr-1"></i>
                                                   Update
                                                </a>
                                             </div>

                                             <div class="card-body-1 personal-record-custom">
                                                <div class="row pers-rec-main v1">
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Height</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3>

                                                               @foreach ($height_feet as $key => $feet)
                                                               {{ (showSelectedValue($key, @$user_details->heightFeet)) ? $feet : '' }}
                                                               @endforeach

                                                               @foreach ($height_inches as $key => $inches)
                                                               {{ (showSelectedValue($key, @$user_details->heightInches)) ? $inches : '' }}
                                                               @endforeach
                                                            </h3>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Smoke</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3>
                                                               @foreach ($smokes as $key => $smoke)
                                                               {{ (showSelectedValue($key, @$user_details->smokingHabits)) ? $smoke : '' }}
                                                               @endforeach
                                                            </h3>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Weight (lbs)</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3>{{ @$user_details->weight }}</h3>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Drink</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3>
                                                               @foreach ($drinks as $key => $drink)
                                                               {{ (showSelectedValue($key, @$user_details->drinkingHabits)) ? $drink : '' }}
                                                               @endforeach
                                                            </h3>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Blood Type</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3>
                                                               @foreach ($blood_types as $key => $blood_type)
                                                               {{ (showSelectedValue($key, @$user_details->bloodType)) ? $blood_type : '' }}
                                                               @endforeach
                                                            </h3>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Exercise</p>
                                                         </div>

                                                         <div class="pre-text">
                                                            <h3>
                                                               @foreach ($exercises as $key => $exercise)
                                                               {{ (showSelectedValue($key, @$user_details->exerciseHabits)) ? $exercise : '' }}
                                                               @endforeach
                                                            </h3>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Blood Pressure</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3><span class="bp-val-sys"> {{ @$user_details->bloodPressureSystolic }} </span> / <span class="bp-val-dia">{{ @$user_details->bloodPressureDiastolic }} </span></h3>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p>Exercise for how long</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3>
                                                               @foreach ($exercise_durations as $key => $exercise_duration)
                                                               {{ (showSelectedValue($key, @$user_details->exerciseLength)) ? $exercise_duration : '' }}
                                                               @endforeach
                                                            </h3>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="per-col">
                                                      <div class="pre-card">
                                                         <div class="pre-title">
                                                            <p class="text-muted mr-3">Marital Status</p>
                                                         </div>
                                                         <div class="pre-text">
                                                            <h3>
                                                               @foreach ($marital_statuses as $key => $marital_status)
                                                               {{ (showSelectedValue($key, @$user_details->maritalStatus)) ? $marital_status : '' }}
                                                               @endforeach
                                                            </h3>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 @endforeach
                                 @endif

                                 <div class="col-md-12 grid-margin">
                                    <div class="containerNext float-right">

                                       @if(Auth::user()->id==$user->id)
                                       <a href="{{url('medications')}}" class="btn btn-primary showLoaderPageLoad">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>
                                       @else
                                       <a href="{{url('medications')}}?user_id={{$user->id}}" class="btn btn-primary showLoaderPageLoad">Next <i class="fa fa-chevron-right fa-arrow-icon"></i></a>
                                       @endif

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
      <!-- Modal -->
      <div class="modal fade" id="personalRecordModalCenter" tabindex="-1" role="dialog" aria-labelledby="personalRecordModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content" id="personal-info-popup">
            </div>
         </div>
      </div>
   </div>

   <script>
      function submitPersonalRecord() {

         let heightFeet = $("#heightFeet").val();
         let heightInches = $("#heightInches").val();
         let weight = $("#weights_req").val();

         if (heightFeet == "") {
            toastr.error("Height is required.");
            return false;
         }
         if (heightInches == "") {
            toastr.error("Height Inches is required.");
            return false;
         }
         console.log(weight);
         if (weight == "") {
            toastr.error("Weight is required.");
            return false;
         }

      }
   </script>
   @endsection
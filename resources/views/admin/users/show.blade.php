@extends('admin.layouts.dashboard')
@section('title', 'users')
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
                @if($user->user_role == 'others')
                  @php $userName = 'Employee'; @endphp
                @else
                @php $userName = 'Subscriber'; @endphp
                @endif
                  <h3 class="font-weight-bold mb-0">{{ $userName }} Information</h3>
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
                                      <div class="col-md-6">
                                        <div class="row">
                                          <div class="col-xl-6">
                                            <div class="inner-details-box">
                                              <label for="exampleInputWeight">First Name  </label>
                                              <h3 class="text-primary fs-20 font-weight-medium">{{ $user->fname }}</h3>
                                            </div>
                                          </div>
                                          <div class="col-xl-6">
                                            <div class="inner-details-box">
                                              <label for="exampleInputWeight">Last Name</label>
                                              <h3 class="text-primary fs-20 font-weight-medium"> {{ $user->lname }}</h3>
                                            </div>
                                          </div>
                                          <div class="col-xl-6">
                                            <div class="inner-details-box">
                                              <label for="exampleInputWeight">Gender</label>
                                              <h3 class="text-primary fs-20 font-weight-medium"> {{ $user->gender=="m" ? "Male" : "Female" }}</h3>
                                            </div>
                                          </div>
                                          <div class="col-xl-6">
                                            <div class="inner-details-box">
                                              <label for="exampleInputWeight">Email  </label>
                                              <h3 class="text-primary fs-20 font-weight-medium">{{ $user->email }}</h3>
                                            </div>
                                          </div>
                                          <div class="col-xl-6">
                                            <div class="inner-details-box">
                                              <label for="exampleInputWeight">Primary Phone</label>
                                              <h3 class="text-primary fs-20 font-weight-medium">{{ $user->primaryPhone }}</h3>
                                            </div>
                                          </div>
                                          @if($user->secondaryPhone)
                                          <div class="col-xl-6">
                                            <div class="inner-details-box">
                                              <label for="exampleInputWeight">Secondary Phone</label>
                                              <h3 class="text-primary fs-20 font-weight-medium">{{ $user->secondaryPhone }}</h3>
                                            </div>
                                          </div>
                                          @endif
                                          <div class="col-xl-6">
                                            <div class="inner-details-box">
                                              <label for="exampleInputWeight">Address</label>
                                              <h3 class="text-primary fs-20 font-weight-medium">{{ $user->address }}</h3>
                                            </div>
                                          </div>
                                          @if($user->address2)
                                          <div class="col-xl-6">
                                            <div class="inner-details-box">
                                              <label for="exampleInputWeight">Address 2</label>
                                              <h3 class="text-primary fs-20 font-weight-medium">{{ $user->address2 }}</h3>
                                            </div>
                                          </div>
                                          @endif
                                          <div class="col-xl-6">
                                            <div class="inner-details-box">
                                              <label for="exampleInputWeight">Zip Code  </label>
                                              <h3 class="text-primary fs-20 font-weight-medium">{{ $user->zipCode }}</h3>
                                            </div>
                                          </div>
                                          <div class="col-xl-6">
                                            <div class="inner-details-box">
                                              <label for="exampleInputWeight">City</label>
                                              <h3 class="text-primary fs-20 font-weight-medium">{{ $user->city }}</h3>
                                            </div>
                                          </div>
                                          <div class="col-xl-6">
                                            <div class="inner-details-box">
                                              <label for="exampleInputWeight">State</label>
                                              <h3 class="text-primary fs-20 font-weight-medium">{{ $state ? $state->name : "" }}</h3>
                                            </div>
                                          </div>
                                          <div class="col-xl-6">
                                            <div class="inner-details-box">
                                              <label for="exampleInputWeight">Timezone</label>
                                              <h3 class="text-primary fs-20 font-weight-medium">{{ $timezone ? $timezone->name : "" }}</h3>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-6" style="display:none;">
                                          <div class="user-activity-card">
                                            <div class="activityHead">
                                            <h4>Activities</h4>
                                          </div>
                                            <div class="all-consultations-box  p-3 activity-cons-box">
                                                <ul>
                                                  @if( count($user->activityLogs) > 0 )
                                                    @foreach($user->activityLogs as $key => $value)
                                                        <li>
                                                          <div class="liContainer">
                                                            <div class="test">
                                                              <span><i class="fas fa-pencil-alt"></i></span> 
                                                              {{ ucfirst($value->msg) }}
                                                            </div>
                                                            <div class="time">
                                                              {{ findAge($value->created_at) }}
                                                            </div>
                                                          </div>
                                                        </li>
                                                    @endforeach
                                                    @else
                                                    <li class="empty">No Activities</li>
                                                  @endif

                                                </ul>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-12  ">
                                        @php $redirect = 'subscriber'; @endphp
                                        @if($user->user_role == 'others')
                                          @php $redirect = 'employee'; @endphp
                                        @endif
                                        <button type="button" onclick="window.location='{{ url("admin/users/{$redirect}") }}'" class="btn btn-primary mr-3" >Back</button>
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
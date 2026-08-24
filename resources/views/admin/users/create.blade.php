@extends('admin.layouts.dashboard')
@section('content')
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
                                @php $redirect = 'subscriber'; @endphp
                                        @if(isset($userData) && $userData->user_role == 'others')
                                          @php $redirect = 'employee'; @endphp
                                        @endif
                                <div class="media-body">
                                    <h3 class="font-weight-bold mb-0"></h3>
                                    <a href="{{  url("admin/users/{$redirect}")}}" class="btn-custom"><i
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
                        <form method="post" action="{{ route('admin.users.store') }}" id="admin-user" enctype='multipart/form-data'>
                            @csrf
                            <input type="hidden" name="id" value="{{ $userData->id??'' }}" >
                            <div class="row mb-4">
                              <div class="form-group col-sm-6">
                                  <label for="select-inc-type">First Name*</label>
                                  <input type="text" class="form-control" id="first_name" name="first_name"
                                      placeholder="First name" value="{{ old('first_name') ? old('first_name') :  $userData->fname??'' }}" autocomplete="off">

                              </div>
                              <div class="form-group col-sm-6">
                                  <label for="select-inc-type">Last Name*</label>
                                  <input type="text" class="form-control" id="last_name" name="last_name"
                                      placeholder="Last name" value="{{ old('last_name') ? old('last_name') : $userData->lname??'' }}" autocomplete="off">
                              </div>
                              <div class="form-group col-sm-6">
                                  <label for="form-control">Gender*</label>
                                  <select class="form-control" name="genders">
                                    <option value="">Select</option>
                                    <option {{ ((isset($userData->gender) && $userData->gender == 'm') || (old('genders') && old('genders') == 'm'))?'selected':''; }} value="m">Male</option>
                                    <option {{ ((isset($userData->gender) && $userData->gender == 'f') || (old('genders') && old('genders') == 'f'))?'selected':''; }} value="f">Female</option>
                                  </select>
                              </div>
                              <div class="form-group col-sm-6">
                                  <label for="select-inc-type">Email*</label>
                                  <input type="email" class="form-control" id="email" name="email"
                                      placeholder="Email" value="{{ old('email') ? old('email') :  $userData->email??'' }}" autocomplete="off">
                              </div>
                              <div class="form-group col-sm-6">
                                  <label for="select-inc-type">Primary Phone*</label>
                                  <input type="text" class="form-control" id="primaryphone" name="primaryphone"
                                      placeholder="Primary Phone" value="{{ old('primaryphone') ? old('primaryphone') : $userData->primaryPhone??'' }}" autocomplete="off">
                              </div>
                              <div class="form-group col-sm-6">
                                  <label for="form-control">Timezone*</label>
                                  <select class="form-control" name="timezone">
                                      <option value="">Select</option>
                                      @if( $timezone )
                                        @foreach($timezone as $key => $value)
                                          <option {{ ((isset($userData->timezoneId) && $userData->timezoneId == $value->id) || (old('timezone') && old('timezone') == $value->id))?'selected':''; }} value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                      @endif
                                  </select>
                              </div>

                              <div class="form-group col-sm-6">
                                <label for="form-control">State*</label>
                                <select class="form-control" name="state">
                                    <option value="">Select</option>
                                    @if( $state )
                                      @foreach($state as $key => $value)
                                        <option {{ ((isset($userData->stateid) && $userData->stateid == $value->id) ||(old('state') && old('state') ==  $value->id))?'selected':''; }} value="{{ $value->id }}">{{ $value->name }}</option>
                                      @endforeach
                                    @endif
                                </select>
                              </div>
                              <div class="form-group col-sm-6">
                                <label for="form-control">Role*</label>
                                <select class="form-control" name="user_role">
                                    <option value="">Select</option>
                                    @if( $role )
                                      @foreach($role as $key => $value)
                                        <option {{ (( isset($userData->admin_managers) && $userData->admin_managers == $value->id) || (old('user_role') && old('user_role') == $value->id ))?'selected':''; }} value="{{ $value->id }}">{{ $value->name }}</option>
                                      @endforeach
                                    @endif
                                </select>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="">City*</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                    placeholder="City" value="{{  old('city') ? old('city') : $userData->city??'' }}" autocomplete="off">
                                  </div>
                                  <div class="form-group">
                                      <label for="">Zip Code*</label>
                                      <input type="text" class="form-control" id="zipcode" name="zipcode"
                                          placeholder="Zip Code" value="{{ old('zipcode') ? old('zipcode') : $userData->zipCode??'' }}" autocomplete="off">
                                  </div>
                              </div>
                              <div class="form-group col-sm-6">
                                  <label for="">Address*</label>
                                  <textarea rows="8" class="form-control" id="address" name="address"
                                      placeholder="Address" autocomplete="off">{{ old('address') ? old('address') : $userData->address??'' }}</textarea>
                              </div>
                              <div class="col-sm-12" style="margin-top:10px;">
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

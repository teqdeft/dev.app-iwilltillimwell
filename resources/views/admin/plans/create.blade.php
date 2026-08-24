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
                                <div class="media-body">
                                    <h3 class="font-weight-bold mb-0">Create Plan</h3>
                                    <a href="{{ url('admin/plans') }}" class="btn-custom"><i class="fas fa-chevron-left" aria-hidden="true"></i> Back</a>
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
                        <form method="post" action="{{ route('admin.plans.store') }}" id="plans-form">
                            @csrf
                            <div class="row mb-4">
                                <div class="form-group col-sm-6">
                                    <label for="type">Type*</label>
                                    {!! Form::select('member_type', $member_opt, old('member_type', ''),
                                    ['class'=>"form-control", 'id'=>"member_type"]) !!}
                                </div>

                                <div class="form-group col-sm-6">
                                    <input type="hidden" name="plan_type">
                                    <label for="type">Plan Type*</label>
                                    <select class="form-control planTypeSelection" name="type">
                                        <option value="">Select Plan Type</option>
                                        @if( $type )
                                            @foreach($type as $key => $value)
                                                <option value="{{ $value['name'] }}" planId="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="name"> Name*</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name" autocomplete="off" value="{{ old('name','') }}">
                                </div>
                                <!--single-search-selection-->
                                <div class="form-group col-sm-6">
                                    <label for="interval"> Interval*</label>
                                    {!! Form::select('interval', $interval_opt, old('interval', '') ,
                                    ['class'=>"form-control", 'id'=>"interval"]) !!}
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="amount">Amount*</label>
                                    <input type="text" class="form-control" id="amount" name="amount" placeholder="amount" autocomplete="off" value="{{ old('amount','') }}">
                                </div>



                                <div class="form-group col-sm-12">
                                    <label for="amount">Description*</label>
                                    <textarea class="form-control editor1" name="description" id="plan-ckeditor">{!! old('description') !!}</textarea>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
      CKEDITOR.replace('plan-ckeditor', {
          allowedContent :true,
      });
    </script>
    @endsection

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
                                    <a href="{{ url('admin/safety') }}" class="btn-custom"><i
                                            class="fas fa-chevron-left" aria-hidden="true"></i>Back</a>
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
                        <form method="post" action="{{ route('admin.safety.store') }}" id="safetyPlan" enctype='multipart/form-data'>
                            @csrf
                            <div class="row mb-4">
                              <div class="form-group col-sm-12">
                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="select-inc-type">Type</label>
                                            <select class="form-control saftyPlanType" name="type">
                                                <option value="">Select Type</option>
                                                <option
                                                <?php
                                                    if( old('type') == 'plan' ){
                                                        echo 'selected';
                                                    }elseif( isset($safetyPlan->type) && $safetyPlan->type == 'plan' ){
                                                        echo 'selected';
                                                    }
                                                ?>
                                                value="plan">Plan</option>
                                                <option
                                                <?php
                                                    if( old('type') == 'guide' ){
                                                        echo 'selected';
                                                    }elseif( isset($safetyPlan->type) && $safetyPlan->type == 'guide' ){
                                                        echo 'selected';
                                                    }
                                                ?>
                                                value="guide">Guide</option>
                                                <option
                                                <?php
                                                    if( old('type') == 'crisis' ){
                                                        echo 'selected';
                                                    }elseif( isset($safetyPlan->type) && $safetyPlan->type == 'crisis' ){
                                                        echo 'selected';
                                                    }
                                                ?>
                                                value="crisis">Crisis</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="select-inc-type">Title</label>
                                            <textarea class="form-control editor1" name="title" id="safetyPlan-ckeditor3">{!! $safetyPlan->title??old('title') !!}</textarea>
                                            {{-- <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Title" value="{{ $safetyPlan->title??old('title') }}" autocomplete="off"> --}}
                                            <input type="hidden" name="id" value="{{ $safetyPlan->id??'' }}" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group testAlign">
                                            <label for="select-inc-type ">Icon</label>
                                            <div class="avatar-upload width50">
                                                <div class="avatar-edit">
                                                    <input type="file" accept=".png, .jpg, .jpeg" name="icon" data-page-id="45" data-is-changed="no" data-editor-index="9" data-section-name="section7" id="filePhoto45" class="required borrowerImageFile custom-file-input" data-element-type="old">
                                                    <label for="filePhoto45"></label>
                                                </div>
                                                <div class="salety-avatar-preview avatar-preview">
                                                    <img class="profile-user-img height150 img-responsive img-circle" id="previewHolder45" src="{{ isset($safetyPlan->icon)?asset($safetyPlan->icon):asset('images/dummy.jpg') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                              </div>

                                @if ( isset($safetyPlan->type) && $safetyPlan->type == 'crisis' || old('type') == 'crisis'  )
                                  <div class="form-group col-sm-6 crisis-number">
                                    <label for="select-inc-type">Number</label>
                                    <input type="text" class="form-control" id="number" name="number"
                                                    placeholder="Ex. tel:999" value="{{ $safetyPlan->number??old('number') }}"
                                                    autocomplete="off">
                                    </div>
                                    <div class="form-group col-sm-6 plan-guide-des displayNone">
                                        <label for="select-inc-type">Description</label>
                                        <textarea class="form-control editor1" name="description" id="safetyPlan-ckeditor">{!! $safetyPlan->description??old('description') !!}</textarea>
                                    </div>
                                    <div class="form-group col-sm-6 plan-guide-des displayNone">
                                        <label for="select-inc-type">Inner Description For Warning</label>
                                        <textarea class="form-control editor1" name="inner_description" id="safetyPlan-ckeditor-2">{!! $safetyPlan->inner_description??old('innerdescription') !!}</textarea>
                                    </div>
                                @else
                                   <div class="form-group col-sm-6 crisis-number displayNone">
                                    <label for="select-inc-type">Number</label>
                                    <input type="text" class="form-control" id="number" name="number"
                                                    placeholder="Ex. tel:999" value="{{ $safetyPlan->number??old('number') }}"
                                                    autocomplete="off">
                                    </div>
                                    <div class="form-group col-sm-6 plan-guide-des">
                                        <label for="select-inc-type">Description</label>
                                        <textarea class="form-control editor1" name="description" id="safetyPlan-ckeditor">{!! $safetyPlan->description??old('description') !!}</textarea>
                                    </div>
                                    <div class="form-group col-sm-6 plan-guide-des">
                                        <label for="select-inc-type">Inner Description For Warning</label>
                                        <textarea class="form-control editor1" name="inner_description" id="safetyPlan-ckeditor-2">{!! $safetyPlan->inner_description??old('inner_description') !!}</textarea>
                                    </div>
                                @endif

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
      CKEDITOR.replace('safetyPlan-ckeditor', {
          allowedContent :true,

      });
       CKEDITOR.replace('safetyPlan-ckeditor-2', {
          allowedContent :true,
      });
       CKEDITOR.replace('safetyPlan-ckeditor3', {
          allowedContent :true,
      });
    </script>
    @endsection

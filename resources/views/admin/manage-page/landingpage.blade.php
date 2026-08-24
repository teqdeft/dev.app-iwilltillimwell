@extends('admin.layouts.dashboard')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />

<div class="main-panel main-wrapper-user dashboard-view">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media pc-media-box">
                                <div class="title-heading-icon-box-cus">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold">{{ $page }}</h3>
                                    <a class="btn-custom update" id="update-page"><i class="fa fa-pencils" aria-hidden="true"></i> Update Page Contents</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card dashb-home-screen">
                <div class="card card-body">
                    <div class="all-consultations-box  p-3">
                        <div>
                            <form method="post" enctype="multipart/form-data">
                                <!-- <button class="update btn btn-info" id="update-page"> Update </button> -->


                                @csrf
                                @foreach($pageContents as $key => $eachRow)
                                @if( $eachRow->type=='text')
                                <div class="dashb-home-row">
                                    <h5>{{ $eachRow->section_name }}</h5>
                                    <div class="dashb-editior">
                                        <textarea class="form-control editor1" data-page-id="{{ $eachRow->page_id }}" data-pageid="{{ $eachRow->id }}" data-editor-index="{{ $key }}" data-section-name="{{ $eachRow->section_name }}" id="summary-ckeditor{{ $key }}" name="summary-ckeditor">
                                        {{ html_entity_decode($eachRow->section_content) }}
                                        </textarea>
                                    </div>
                                </div>
                                @elseif($eachRow->type=='single-image')
                                <div class="dashb-home-row">
                                    <h5>{{ $eachRow->section_name }}</h5>
                                    <div class="dashb-editior">
                                        <!-- <input type="file" name="filePhoto" data-page-id="{{ $eachRow->id }}" data-is-changed="no" data-row-id="{{ $eachRow->id }}" data-editor-index="{{ $key }}" data-section-name="{{ $eachRow->section_name }}" id="filePhoto" class="required borrowerImageFile custom-file-input" data-errormsg="PhotoUploadErrorMsg"> -->
                                        <div class="input-group file-upload-wrap">
                                            <div class="custom-file">
                                                <input type="file" name="filePhoto" data-page-id="{{ $eachRow->id }}" data-is-changed="no" data-row-id="{{ $eachRow->id }}" data-editor-index="{{ $key }}" data-section-name="{{ $eachRow->section_name }}" id="filePhoto" class="required borrowerImageFile custom-file-input custom-file-input" data-errormsg="PhotoUploadErrorMsg">
                                                <label class="custom-file-label" for="text1">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="to-show-preview-image">
                                            <img id="previewHolder{{ $eachRow->id }}" alt="Uploaded Image Preview Holder" width="250px" height="250px" src="{{ url($eachRow->section_file) }}" />
                                        </div>
                                    </div>
                                </div>
                                @elseif($eachRow->type=='slider' || $eachRow->type=='gallery' || $eachRow->type=='galleryt2' || $eachRow->type=='boarding')
                                <div class="dashb-home-row">
                                    <h5>{{ $eachRow->section_name }}</h5>
                                    <div id="section-{{ $eachRow->id }}" class="dashb-home-inner-row">
                                        @if(count($eachRow->dependents) > 0)
                                        @foreach($eachRow->dependents as $eachImages)

                                        <div class="dashb-home-cell-row col-md-3" id="div-{{ $eachImages->id }}" data-page-type="{{ $eachRow->type }}" data-main-id="div-{{ $eachImages->id }}">
                                            <div class="dashb-home-col">
                                                <div class="dashb-home-cell">
                                                    <div class="input-group file-upload-wrap">
                                                        <div class="custom-file">
                                                            <textarea class="form-control title get-title" placeholder="Title" row="4" data-page-id="{{ $eachImages->id }}" id="title-{{ $eachImages->id }}" data-element-type="old">{{ $eachImages->section_title }}</textarea>
                                                            <!-- <input type="text" class="form-control title get-title" value="{{ $eachImages->section_title }}" placeholder="Title" data-page-id="{{ $eachImages->id }}" id="title-{{ $eachImages->id }}" data-element-type="old"> -->
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn-custom delete_entry" class="delete_entry" data-row-id="{{ $eachImages->id }}">Delete</button>
                                                        </div>
                                                    </div>

                                                    @if($eachRow->type=='galleryt2')
                                                    <div class="file-upload-wrap">
                                                        <div class="custom-file">
                                                            <textarea class="form-control title get-description customWidth" data-page-id="{{ $eachImages->id }}" id="description-{{ $eachImages->id }}" data-element-type="old" rows="5">{{ $eachImages->section_content }}</textarea>
                                                            <!-- <input type="text" class="form-control title get-description" value="{{ $eachImages->section_content }}" placeholder="Title" data-page-id="{{ $eachImages->id }}" id="description-{{ $eachImages->id }}" data-element-type="old"> -->
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input type='file' accept=".png, .jpg, .jpeg" name="filePhoto" data-page-id="{{ $eachImages->id }}" data-is-changed="no" data-editor-index="{{ $key }}" data-section-name="{{ $eachRow->section_name }}" id="filePhoto{{ $eachImages->id }}" class="required borrowerImageFile custom-file-input" data-element-type="old" />
                                                            <label for="filePhoto{{ $eachImages->id }}"></label>
                                                        </div>
                                                        <div class="avatar-preview">
                                                            <img class="profile-user-img img-responsive img-circle" id="previewHolder{{ $eachImages->id }}" alt="Uploaded Image Preview Holder" src="{{ url($eachImages->section_file) }}" alt="User profile picture">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                        @if($eachRow->type!='boarding')
                                        <button class="new_entry btn-custom" data-section-id="{{ $eachRow->id }}">Add New</button>
                                        @endif
                                        @endif
                                    </div>

                                </div>
                                @endif
                                @endforeach
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        $('.editor1').each(function() {
            CKEDITOR.replace($(this).prop('id'), {
                allowedContent: true,
                versionCheck: false
            });
        });
    </script>

    @endsection
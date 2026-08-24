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
                                    <h3 class="font-weight-bold mb-0">Create Media Hub</h3>
                                    <a href="{{ url('admin/blog') }}" class="btn-custom"><i
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
                        <form method="post" action="{{ route('admin.blog.store') }}" id="blog" enctype='multipart/form-data'>
                            @csrf
                            <div class="row mb-4">
                              <div class="form-group col-sm-12">
                                <label for="category">Select Category*</label>
                                {!! Form::select('category_id', $category_options, old('category_id', $category_id??old('category_id')) ,
                                ['class'=>"form-control", 'id'=>"category_id"]) !!}
                              </div>
                              <div class="form-group col-sm-12">
                                  <label for="select-inc-type">Title</label>
                                  <input type="text" class="form-control" id="title" name="title"
                                      placeholder="Title" value="{{ $blog->title??old('title') }}" autocomplete="off">
                                  <input type="hidden" name="id" value="{{ $blog->id??'' }}" >
                              </div>

                              <div class="form-group col-sm-12">
                                  <label for="select-inc-type">Post</label>
                                  <textarea class="form-control editor1" name="post" id="blog-ckeditor">{!! $blog->post??old('post') !!}</textarea>
                              </div>

                              <div class="col-md-8">
                                <label for="select-inc-type">Banner</label>
                                <div class="avatar-upload">
                                   <div class="avatar-edit">
                                      <input type="file" accept=".png, .jpg, .jpeg" name="banner" data-page-id="45" data-is-changed="no" data-editor-index="9" data-section-name="section7" id="filePhoto45" class="required borrowerImageFile custom-file-input" data-element-type="old">
                                      <label for="filePhoto45"></label>
                                   </div>
                                   <div class="avatar-preview">
                                      <img class="profile-user-img img-responsive img-circle" id="previewHolder45" src="{{ isset($blog->banner)?asset($blog->banner):asset('images/dummy.jpg') }}">
                                   </div>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <label for="select-inc-type">Thumbnail</label>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type="file" accept=".png, .jpg, .jpeg" name="thumbnail" data-page-id="11" data-is-changed="no" data-editor-index="7" data-section-name="section3-left" id="filePhoto11" class="required borrowerImageFile custom-file-input" data-element-type="old">
                                        <label for="filePhoto11"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <img class="profile-user-img img-responsive img-circle" id="previewHolder11" src="{{ isset($blog->thumbnail)?asset($blog->thumbnail):asset('images/dummy.jpg') }}">
                                    </div>
                                </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
      CKEDITOR.replace('blog-ckeditor', {
          allowedContent :true,
          filebrowserUploadUrl: "{{route('admin.blog.ckupload', ['_token' => csrf_token() ])}}",
          filebrowserUploadMethod: 'form'
      });
    </script>
    @endsection

@extends('admin.layouts.dashboard')
@section('content')
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
                                    <h3 class="font-weight-bold">Terms & Conditions</h3>
                                    <a class="btn-custom update" id="submit-form-rss" style="line-height: 44px !important;"><i class="fa fa-pencils" aria-hidden="true"></i> Update Terms & Conditions</a>
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
                            <form method="post" id="rss-feed-forms">
                                @csrf
                                <div class="row mb-4" id="appendRssFeed">
                                    @if( empty($rss) )
                                        @php $rss = [['title' => '','description' => '']]; @endphp
                                    @endif
                                        @php $i = 0; $count = count($rss); @endphp
                                        @foreach($rss as $key => $value)
                                            <div class="col-sm-12" id="rss-feed-section">
                                                <div id="rssClone" class="row">
                                                    <div class=" col-sm-8">
                                                        <label for="valid_from">Title</label>
                                                        <div class="dob-cal-box">
                                                            <input type="text" class="form-control" name="title[]" value="{{ $value->title??'' }}" />
                                                        </div>
                                                    </div>
                                                    <div class=" col-sm-8 ">
                                                        <label for="valid_from">Description</label>
                                                        <div class="dob-cal-box">
                                                        <textarea class="form-control editor1" id="summary-ckeditor{{ $i }}" name="summary-ckeditor">
                                                        </textarea>
                                                        </div>
                                                    </div>
                                                    <div class=" col-sm-2">
                                                        <button type="button" class="delete_rss btn btn-danger mr-3" id="rss-feeds-delete" style="display: {{ (($count - 1 ) == $key)?'none':'block'; }}">Delete</button>
                                                        <button type="button" class="add_more_rss btn btn-success mr-3" id="rss-feeds-add" style="display: {{ (($count - 1 ) == $key)?'block':'none'; }}" ><i class="fas fa-plus"></i>Add More</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @php $i++; @endphp
                                        @endforeach
                                    
                                </div>
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
                allowedContent: true
            });
        });
    </script>
@endsection
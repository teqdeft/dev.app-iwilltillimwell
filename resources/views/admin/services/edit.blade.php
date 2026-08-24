@extends('admin.layouts.dashboard')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.css" rel="stylesheet" />
<style>
    .services-consulat-box>.row h4 {
        font-size: 30px;
    }

    .services-consulat-box>.row {
        padding-bottom: 50px;
    }

    .row.section-conatiner {
        border: 1px solid #ddd;
        padding: 30px;
        margin-bottom: 70px;
    }
</style>
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
                                    <h3 class="font-weight-bold">Our Corporate</h3>

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
                    <div class="all-consultations-box  p-3 services-consulat-box">
                        <div>
                            <form method="post" id="serviceform" enctype="multipart/form-data" action="{{ url('admin/corporate/store') }}">
                                @csrf

                                <input type="hidden" name="company-details[id]" value="{{ $company['company-details']['id']??'' }}">
                                <!-- company and Logo -->
                                <div class="dashb-home-row row">
                                    <input type="hidden" name="services[banner][id]" value="{{ $company['banner']['id']??'' }} ">
                                    {!! labelh5('Banner') !!}
                                    <div class="col-md-12">

                                        {!! titleNDesc('services[banner][title]','services[banner][description]',$company['banner']['title'],$company['banner']['description']) !!}
                                    </div>
                                </div>

                                <div class="dashb-home-row row">
                                    {!! labelh5('Corporate Details')!!}

                                    <div class="col-md-6">
                                        {!! imageSelector('company-details[image]','','',$company['company-details']['image']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! comTitleNDesc('company-details[title]','company-details[description]',$company['company-details']['slug'],$company['company-details']['title'],$company['company-details']['description']) !!}
                                    </div>
                                </div>

                                <!-- section 1 -->

                                <div class="dashb-home-row row">
                                    <input type="hidden" name="services[emotional-wellness][id]" value="{{ $company['emotional-wellness']['id']??'' }}">
                                    {!! labelh5('Emotional Wellness') !!}
                                    <div class="col-md-6">
                                        {!! changeStatus('services[emotional-wellness][status]',$company['emotional-wellness']['status']) !!}
                                        {!! titleNDesc('services[emotional-wellness][title]','services[emotional-wellness][description]',$company['emotional-wellness']['title']??'',$company['emotional-wellness']['description']??'') !!}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="servicesTitleAndDes">
                                            {!! imageSelector('services[emotional-wellness][image][]','mental-wellness','',$company['emotional-wellness']["image"][0]??'') !!}
                                        </div>
                                    </div>
                                    {{-- {!! labelh5('Subroofs') !!}
                                    <div class="col-md-6">
                                        {!! titleNDescWithOutCKD('services[emotional-wellness][child][first][title]','services[emotional-wellness][child][first][description]',$company['emotional-wellness']['child'][0]['title']??'',$company['emotional-wellness']['child'][0]['description']??'') !!}
                                        <input type="hidden" value="{{ $company['emotional-wellness']['child'][0]['id']??'' }}" name="services[emotional-wellness][child][first][id]">
                                    </div>
                                    <div class="col-md-6">
                                        {!! titleNDescWithOutCKD('services[emotional-wellness][child][second][title]','services[emotional-wellness][child][second][description]',$company['emotional-wellness']['child'][1]['title']??'',$company['emotional-wellness']['child'][1]['description']??'') !!}
                                        <input type="hidden" value="{{ $company['emotional-wellness']['child'][1]['id']??'' }}" name="services[emotional-wellness][child][second][id]">
                                    </div> --}}
                                    <div class="col-md-6">
                                        {!! labelh5('Learn More Emotional Wellness') !!}

                                        <div class="form-group">
                                            <label>Learn More</label>
                                            <select class="slim-emotional-wellness-edit form-control" name="services[emotional-wellness][learn-more]">
                                                @if ( $pages )
                                                    @foreach ($pages as $key => $value)
                                                        <option @if ( $company['emotional-wellness']['learn_more'] == $value->slug )
                                                            selected
                                                        @endif value="{{ $value->slug }}">{{ $value->page_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- section 2 -->

                                <div class="dashb-home-row row">
                                    <input type="hidden" name="services[medical-care][id]" value="{{ $company['medical-care']['id']??'' }}">
                                    {!! labelh5('Medical Care') !!}
                                    <div class="col-md-6">
                                        {!! changeStatus('services[medical-care][status]',$company['medical-care']['status']) !!}
                                        {!! titleNDesc('services[medical-care][title]','services[medical-care][description]',$company['medical-care']['title']??'',$company['medical-care']['description']??'') !!}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="servicesTitleAndDesSecond sliderContainer">
                                            <div class="row">
                                                @if( isset($company['medical-care']['image']) && !empty($company['medical-care']['image']) )
                                                @foreach ($company['medical-care']['image'] as $key => $value )
                                                <div class="col-md-3 sliderImages">
                                                    {!! imageSelector('services[medical-care][image][]','medical-care','height:190px;',$value,$key) !!}
                                                    @if( $key > 0 )
                                                    <div class="serviceimagesRemove"><i class="fas fa-times"></i></div>
                                                    @endif
                                                </div>

                                                @endforeach
                                                @else
                                                <div class="col-md-3 sliderImages">
                                                    {!! imageSelector('services[medical-care][image][]','medical-care','height:190px;') !!}
                                                </div>
                                                @endif
                                            </div>
                                            <div class="add-more-box">
                                                <button type="button" class="btn btn-success add-more-slider">Add More</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {!! labelh5('Learn More Redirection') !!}
                                        <div class="form-group">
                                            <label>Learn More</label>
                                            <select class="slim-medical-care-edit form-control" name="services[medical-care][learn-more]">
                                                @if ( $pages )
                                                    @foreach ($pages as $key => $value)
                                                        <option @if ( $company['medical-care']['learn_more'] == $value->slug )
                                                            selected
                                                        @endif value="{{ $value->slug }}">{{ $value->page_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- section 3 -->
                                <div class="dashb-home-row row">
                                    <input type="hidden" name="services[tele-pet-now][id]" value="{{ $company['tele-pet-now']['id']??'' }}">
                                    {!! labelh5('Tele-Vet Now') !!}
                                    <div class="col-md-6">
                                        {!! changeStatus('services[tele-pet-now][status]',$company['tele-pet-now']['status']) !!}
                                        {!! titleNDesc('services[tele-pet-now][title]','services[tele-pet-now][description]',$company['tele-pet-now']['title']??'',$company['tele-pet-now']['description']??'') !!}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="servicesTitleAndDesSecond sliderContainer">
                                            <div class="row">
                                                @if( isset($company['tele-pet-now']['image']) && !empty($company['tele-pet-now']['image']) )
                                                @foreach ($company['tele-pet-now']['image'] as $key => $value )
                                                <div class="col-md-3 sliderImages">
                                                    {!! imageSelector('services[tele-pet-now][image][]','tele-pet-now','height:190px;',$value,$key) !!}
                                                    @if( $key > 0 )
                                                    <div class="serviceimagesRemove"><i class="fas fa-times"></i></div>
                                                    @endif
                                                </div>
                                                @endforeach
                                                @else
                                                    <div class="col-md-3 sliderImages">
                                                        {!! imageSelector('services[tele-pet-now][image][]','tele-pet-now','height:190px;') !!}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="add-more-box">
                                                <button type="button" class="btn btn-success add-more-slider">Add More</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {!! labelh5('Learn More Redirection') !!}
                                        <div class="form-group">
                                            <label>Learn More</label>
                                            <select class="slim-tele-pet-now-edit form-control" name="services[tele-pet-now][learn-more]">
                                                @if ( $pages )
                                                    @foreach ($pages as $key => $value)
                                                        <option @if ( $company['tele-pet-now']['learn_more'] == $value->slug )
                                                            selected
                                                        @endif value="{{ $value->slug }}">{{ $value->page_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                   <div class="dashb-home-row row">
                                    {!! labelh5('Learn More Redirection') !!}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Learn More</label>
                                            <select id="slim-select" name="learn_more">
                                                @if ( $pages )
                                                    @foreach ($pages as $key => $value)
                                                        <option value="{{ $value->slug }}" @if ( $company['company-details']['learn_more'] == $value->slug )
                                                            selected
                                                        @endif >{{ $value->page_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button button type="submit" class="btn btn-primary mr-3" id="submit">Submit</button>
                                        </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.js"></script>


        <script>
            $(document).ready(function() {
                $('.servicesDescription').each(function() {
                    CKEDITOR.replace($(this).attr('id'), {
                        allowedContent: true,
                    });
                })

                new SlimSelect({
				select: '#slim-emotional-wellness-edit'
                })

                new SlimSelect({
                    select: '#slim-medical-care-edit'
                })

                new SlimSelect({
                    select: '#slim-tele-pet-now-edit'
                })

            })


            const slugify = str => str.toLowerCase().trim().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '');

            $(document).on('keyup',"input[name='company-details[title]']",function(){
                let slugText = $(this).val();
                $("input[name='company-details[slug]']").val(slugify(slugText));
            })

        </script>
        @endsection

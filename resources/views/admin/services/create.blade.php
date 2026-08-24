@extends('admin.layouts.dashboard')
@section('content')
<style>
.services-consulat-box>.row   h4 {
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

                                <div class="dashb-home-row row">
                                    {!! labelh5('Banner') !!}
                                    <div class="col-md-12">

                                        {!! titleNDesc('services[banner][title]','services[banner][description]') !!}
                                    </div>
                                </div>

                            <!-- company and Logo -->
                            <div class="dashb-home-row row">
                                {!! labelh5('Corporate Details')  !!}
                                    <div class="col-md-6">
                                        {!! imageSelector('company-details[image]') !!}
                                    </div>
                                    <div class="col-md-6">

                                        {!! comTitleNDesc('company-details[title]','company-details[description]') !!}
                                    </div>
                                </div>

                                <!-- section 1 -->

                                <div class="dashb-home-row row">
                                    {!! labelh5('Emontional ') !!}
                                    {!! changeStatus('services[emotional-wellness][status]',1) !!}
                                    <div class="col-md-6">
                                        {!! titleNDesc('services[emotional-wellness][title]','services[emotional-wellness][description]') !!}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="servicesTitleAndDes">
                                            {!! imageSelector('services[emotional-wellness][image][]','mental-wellness') !!}
                                        </div>
                                    </div>
                                    {{-- {!! labelh5('Subroofs') !!}
                                    <div class="col-md-6">
                                        {!! titleNDescWithOutCKD('services[emotional-wellness][child][first][title]','services[emotional-wellness][child][first][description]') !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! titleNDescWithOutCKD('services[emotional-wellness][child][second][title]','services[emotional-wellness][child][second][description]') !!}
                                    </div> --}}
                                    <div class="col-md-6">
                                        {!! labelh5('Learn More Redirection') !!}
                                        <div class="form-group">
                                            <label>Learn More</label>
                                            <select id="slim-emotional-wellness" name="services[emotional-wellness][learn-more]">
                                                @if ( $pages )
                                                    @foreach ($pages as $key => $value)
                                                        <option value="{{ $value->slug }}">{{ $value->page_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- section 2 -->

                                 <div class="dashb-home-row row">
                                    {!! labelh5('Medical Care') !!}
                                    {!! changeStatus('services[medical-care][status]',1) !!}
                                    <div class="col-md-6">
                                        {!! titleNDesc('services[medical-care][title]','services[medical-care][description]') !!}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="servicesTitleAndDesSecond sliderContainer">
                                            <div class="row">
                                                <div class="col-md-3 sliderImages">
                                                    {!! imageSelector('services[medical-care][image][]','medical-care','height:190px;') !!}
                                                </div>
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
                                            <select id="slim-medical-care" name="services[emotional-wellness][learn-more]">
                                                @if ( $pages )
                                                    @foreach ($pages as $key => $value)
                                                        <option value="{{ $value->slug }}">{{ $value->page_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- section 3 -->
                                 <div class="dashb-home-row row">
                                    {!! labelh5('Tele-Vet Now') !!}
                                    {!! changeStatus('services[tele-pet-now][status]',1) !!}
                                    <div class="col-md-6">
                                        {!! titleNDesc('services[tele-pet-now][title]','services[tele-pet-now][description]') !!}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="servicesTitleAndDesSecond sliderContainer">
                                            <div class="row">
                                                <div class="col-md-3 sliderImages">
                                                    {!! imageSelector('services[tele-pet-now][image][]','tele-pet-now','height:190px;') !!}
                                                </div>
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
                                            <select id="slim-tele-pet-now" name="services[emotional-wellness][learn-more]">
                                                @if ( $pages )
                                                    @foreach ($pages as $key => $value)
                                                        <option value="{{ $value->slug }}">{{ $value->page_name }}</option>
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
                                                        <option value="{{ $value->slug }}">{{ $value->page_name }}</option>
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
            })

            const slugify = str => str.toLowerCase().trim().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '');

            $(document).on('keyup',"input[name='company-details[title]']",function(){
                let slugText = $(this).val();
                $("input[name='company-details[slug]']").val(slugify(slugText));
            })

        </script>
        @endsection

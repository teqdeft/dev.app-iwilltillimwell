@extends('admin.layouts.dashboard')
@section('content')

<div class="main-panel main-wrapper-user">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media pc-media-box">
                                <div class="title-heading-icon-box-cus">
                                    <i class="fas fa-user-tag"></i>
                                </div>
                                @if(Session::has('message'))
                                <p class="alert alert-info">{{ Session::get('message') }}</p>
                                @endif
                                <div class="media-body">
                                    <h3 class="font-weight-bold">Categories</h3>
                                    @if( permission_exist('blog_categories_add',$permissions??'') )
                                      <a href="{{ route('admin.categories.create') }}" class="btn-custom"><i class="fas fa-address-card" aria-hidden="true"></i> Create Category</a>
                                    @endif
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
                        <div>
                            <div id="all">
                                <div class="table-responsive pt-3">
                                    <table class="table table-bordered user-table-box" id="categories-table">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if($categories)
                                            @foreach ($categories as $category)
                                            <tr>

                                            </tr>
                                            @endforeach
                                            @else
                                            <tr class="no-data-row">
                                                <td colspan="5" rowspan="2" align="center">
                                                    <div class="message">
                                                        <p>You have not yet create a new!</p>
                                                    </div>
                                                    <div class="invoice-btns">
                                                        <a href="{{ route('clients.create') }}" class="btn-custom"><i class="fa fa-plus" aria-hidden="true"></i>New Category</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

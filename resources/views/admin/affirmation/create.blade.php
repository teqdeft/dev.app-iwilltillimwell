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
                                    <h3 class="font-weight-bold mb-0">@if ( isset( $id ) )
                                        Edit @else Create
                                    @endif Affirmation</h3>
                                    <a href="{{ url('admin/affirmation') }}" class="btn-custom"><i class="fas fa-chevron-left" aria-hidden="true"></i> Back</a>
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
                        <form method="post" action="{{ route('admin.affirmation.store') }}" id="affirmation-form">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id??'' }}" />
                            <div class="row mb-4">
                                <div class="form-group col-md-12">
                                    <label for="name"> Type*</label>
                                    <select class="form-control" name="parent_type">
                                        <option value="" >Select affirmation type</option>
                                        @if ( !$type->isEmpty() )
                                            @foreach ($type as $value )
                                                <option @if( $affirmation ) @if( $affirmation[0]->parent_type == $value->id  ) selected @endif @endif  value="{{ $value->id }}" >{{ ucfirst($value->message) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="name"> Message*</label>
                                    <textarea class="form-control" rows="10" name="message" >{{ $affirmation[0]->message??'' }}</textarea>
                                    <input type="hidden" name="type" value="1" >
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mr-3 floatRight" id="submit">Submit</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection

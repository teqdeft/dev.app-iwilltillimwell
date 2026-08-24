@extends('layouts.admin.dashboard')

@section('title', trans('labels.edit').' '.trans('labels.country'))

@section('content')
@inject('controller', 'App\Http\Controllers\Controller')

<div class="dashboard-right">
    <div class="menu-icon">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="invoice-container">
        <h2>{{ __('labels.edit').' '.__('labels.country') }}</h2>
        {{ Form::open(array('method'=>'PUT', 'route' => ['country_edit_update', $country], 'id' => 'edit-country-form')) }}
            <div class="default-form add-new-contact-form">
                <div class="generate-invoice">
                    <div class="add-form row">
                        <div class="form-group col-md-6">
                            <label for="en_name">{{ __('labels.name') }} ({{ __('constants.en') }}) <span>*</span></label>
                            <input class="form-control" type="text" name="en_name" placeholder="{{ __('labels.name') }}" value="{{ old('en_name', $country->getTranslation('name', 'en')) }}" autocomplete="off" />
                            @error('en_name')
                                <span class="error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="es_name">{{ __('labels.name') }} ({{ __('constants.es') }}) <span>*</span></label>
                            <input class="form-control" type="text" name="es_name" placeholder="{{ __('labels.name') }}" value="{{ old('es_name', $country->getTranslation('name', 'es')) }}" autocomplete="off" />
                            @error('es_name')
                                <span class="error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="comments-section">
                    <div class="form-group popup-btns">
                        <a href="{{ route('admin.countries') }}"><button type="button" name="cancel" class="btn-custom cancel-btn">{{ __('labels.cancel') }}</button></a>
                        <button type="submit" name="submit" class="btn-custom">{{ __('labels.update') }}</button>
                    </div>
            </div>
        </form>
    </div>
</div>
<div class="clearfix"></div>
</div>
@endsection

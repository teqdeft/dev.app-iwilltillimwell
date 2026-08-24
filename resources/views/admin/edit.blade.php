@extends('layouts.admin.dashboard')

@section('title', trans('labels.edit').' '.trans('labels.user'))

@section('content')
@inject('controller', 'App\Http\Controllers\Controller')

<div class="dashboard-right">
    <div class="menu-icon">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="invoice-container">
        <h2>{{ __('labels.edit').' '.__('labels.user') }}</h2>
        {{ Form::open(array('method'=>'POST', 'route' => ['admin.update'], 'id' => 'edit-user-form')) }}
            <div class="default-form add-new-contact-form">
                <div class="generate-invoice">
                    <div class="add-form row">
                        <div class="form-group col-md-6">
                            <label for="name">{{ __('labels.name') }} <span>*</span></label>
                            <input class="form-control" type="text" name="name" placeholder="{{ __('labels.name') }}" value="{{ old('name', $user->name) }}" autocomplete="off" />
                            @error('name')
                                <span class="error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="language">{{ __('labels.language') }}</label>
                            {!! Form::select('language', $controller::mapOptionsBasedOnLocale(Config::get('constants.languages')), old('language', $user->language), ['class'=>"form-control", 'id'=>"language"]) !!}
                            @error('language')
                                <span class="error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <a href="javascript:void(0)" id="change-password-link">{{ __('labels.change_password') }}</a>
                        </div>
                    </div>
                    <div id="change-password-section" class="{{ $errors->has('password') || $errors->has('current_password') ? '' : 'hide-section'}} row">
                        <div class="form-group col-md-4">
                            <label for="current_password">{{ __('labels.password') }} </label>
                            <input class="form-control" type="password" name="current_password" placeholder="{{ __('labels.password') }}" autocomplete="off" id="current_password" />
                            @error('current_password')
                                <span class="error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="password">{{ __('labels.new').' '.__('labels.password') }} </label>
                            <input class="form-control" type="password" name="password" placeholder="{{ __('labels.new').' '.__('labels.password') }}" autocomplete="off" id="password" />
                            @error('password')
                                <span class="error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="password">{{ __('labels.confirm_password') }} </label>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="{{ __('labels.confirm_password') }}" autocomplete="off" id="password-confirm" />
                            @error('password_confirmation')
                                <span class="error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="comments-section">
                    <div class="form-group popup-btns">
                        <a href="{{ route('admin-dashboard') }}"><button type="button" name="cancel" class="btn-custom cancel-btn">{{ __('labels.cancel') }}</button></a>
                        <button type="submit" name="submit" class="btn-custom">{{ __('labels.update') }}</button>
                    </div>
            </div>
        </form>
    </div>
</div>
<div class="clearfix"></div>
</div>
@endsection

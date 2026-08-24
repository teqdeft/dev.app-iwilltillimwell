{{ __('hi') }}, 
<b>{{ $estimate->company->name }}</b> {{ __('shared_an') }} <b>{{ __('estimate ').$estimate->internal_number }}</b> {{ __('with_you') }}.

{{ __('find_attachment_for_estimate_details') }}.

{{ __('regards') }},
{{ config('app.name', 'Tele Medicine') }}

© {{date("Y")}} {{ config('app.name', 'Tele Medicine') }}. {{ __('all_rights_reserved') }}.
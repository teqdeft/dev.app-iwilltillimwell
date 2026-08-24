@inject('controller', 'App\Http\Controllers\Controller')

@extends('layouts.admin.dashboard')

@section('title', trans('labels.sectors'))

@section('content')
<div class="dashboard-right cust-dashboard-md-right">
    <div class="menu-icon">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="invoice-container">
        <h2>{{ __('labels.sectors') }}</h2>
        <div class="invoice-btns invoice-btns-position">
        </div>
        <div class="tabs-custom">
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="list-table-custom  products-table">
                        <table class="table table-striped" id="sectors-list-table">
                            <thead>
                                <tr>
                                    <th>{{ __('labels.name') }} ({{ __('constants.en') }})</th>
                                    <th>{{ __('labels.name') }} ({{ __('constants.es') }})</th>
                                    <th>{{ __('labels.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($sectors as $sector)
                                <tr>
                                    <td>{{ $sector->getTranslation('name', 'en') }}</td>
                                    <td>{{ $sector->getTranslation('name', 'es') }}</td>
                                    <td class="to-show">
                                        <div class="inner-to-show">
                                            <i class="fa fa-sort-desc action-btn" class="dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a href="{{route('sector_edit_update', $sector)}}">{{ __('labels.edit') }}</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr class="no-data-row">
                                <td colspan="7" rowspan="2" align="center">
                                    <div class="message"><p>{{ __('labels.no_records_found') }}</p></div>
                                </td>
                            </tr>
                            @endforelse                                
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
@endsection

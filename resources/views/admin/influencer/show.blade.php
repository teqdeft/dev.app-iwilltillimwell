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
                <div class="media-body">
                  <h3 class="font-weight-bold">Affiliates</h3>                

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
                  <table class="table table-bordered user-table-box" id="admin-transaction-table">
                    <thead>
                      <tr>
                        <th>Sno.</th>
                        <th>Promo Code</th>
                        <th>Member Name</th>
                        <th>Commission</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>

                      @if($transactions)
                      @foreach ($transactions as $transaction)
                      <tr>
                        <!-- <td>1</td>
                        <td>{{ $transaction->promocode->code }}</td>
                        <td>{{ $transaction->member->name }}</td>
                        <td>{{ $transaction->commission_amount }}</td>
                        <td>{{ $transaction->custom_status }}</td> -->
                      </tr>
                      @endforeach
                      @else
                      <tr class="no-data-row">
                        <td colspan="5" rowspan="2" align="center">
                          <div class="message">
                            <p>You have not yet create a new!</p>
                          </div>
                          <div class="invoice-btns">
                            <a href="{{ route('clients.create') }}" class="btn-custom"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('labels.new_client') }}</a>
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
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
                                <div class="media-body theme-title-box">
                                    <h3 class="font-weight-bold">Import Users &mdash; {{ $org->name }}</h3>
                                    <div class="theme-btn-cont organization-btn-cont">

                                        {{-- Same dropdown pattern as Import Subscriber --}}
                                        <div class="dropdown uploadSubsSheet">
                                            <a class="btn btn-custom dropdown-toggle" type="button"
                                               id="dropdownMenuButton" data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                Import Users
                                            </a>
                                            <div class="dropdown-menu uploadSbsContainer" aria-labelledby="dropdownMenuButton">
                                                <form action="{{ route('imwell.admin.import.run', $org->id) }}"
                                                      method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="sheet" class="form-control"
                                                           accept=".csv,.xlsx,.xls" required>
                                                    <div class="sbsButton">
                                                        <div class="sheetType">
                                                            <a download class="removeHrefClass"
                                                               href="{{ route('imwell.admin.import.sample', ['format' => 'xlsx']) }}">Download xlsx format</a>
                                                            <a download class="removeHrefClass"
                                                               href="{{ route('imwell.admin.import.sample', ['format' => 'csv']) }}">Download csv format</a>
                                                        </div>
                                                        <div class="sheetUploadButton">
                                                            <input type="submit" class="btn btn-sm btn-primary" value="Submit">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <a href="{{ route('imwell.admin.import.members', $org->id) }}" class="btn-custom">
                                            <i class="fas fa-users" aria-hidden="true"></i> View Members
                                        </a>
                                        <a href="{{ route('imwell.admin.index') }}" class="btn-custom">
                                            <i class="fas fa-arrow-left" aria-hidden="true"></i> Back to list
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('ImwellApp::admin.partials.flash')

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-body">
                    <div class="all-consultations-box  p-3">

                        <p class="imwell-note">
                            Every member in the sheet is linked to <strong>{{ $org->name }}</strong> automatically &mdash;
                            no organization column is needed. The first row must be a header row; column order does not
                            matter. Each member is emailed a one-time activation link for
                            <a target="_blank" href="{{ $org->url() }}">{{ $org->url() }}</a>, where they set their own
                            password. No password is ever generated or emailed.
                        </p>

                        <div class="table-responsive pt-3">
                            <table class="table table-bordered user-table-box">
                                <thead>
                                    <tr>
                                        <th>Column</th>
                                        <th>Required</th>
                                        <th>Column</th>
                                        <th>Required</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>first_name</td><td>Yes</td><td>address</td><td>No</td></tr>
                                    <tr><td>last_name</td><td>Yes</td><td>address2</td><td>No</td></tr>
                                    <tr><td>email</td><td>Yes</td><td>city</td><td>No</td></tr>
                                    <tr><td>phone</td><td>No</td><td>state</td><td>No</td></tr>
                                    <tr><td>dob</td><td>No</td><td>zip_code</td><td>No</td></tr>
                                    <tr><td>gender</td><td>No</td><td></td><td></td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @if($result)
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-body">
                    <div class="all-consultations-box  p-3">

                        <h4 class="font-weight-bold">Last import result</h4>
                        <p>
                            <label class="badge badge-success">{{ $result['created'] }} imported</label>
                            <label class="badge badge-danger">{{ count($result['skipped']) }} skipped</label>
                        </p>

                        @if(count($result['skipped']))
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered user-table-box">
                                    <thead>
                                        <tr><th>Row</th><th>Email</th><th>Reason skipped</th></tr>
                                    </thead>
                                    <tbody>
                                    @foreach($result['skipped'] as $row)
                                        <tr>
                                            <td>{{ $row['line'] }}</td>
                                            <td>{{ $row['email'] }}</td>
                                            <td>{{ $row['reason'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <p class="imwell-note">
                                Fix these rows and upload again &mdash; members already imported are skipped as duplicates.
                            </p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

<style>
    .imwell-note { font-size: 13px; color: #7b8190; margin-bottom: 0; line-height: 1.7; }
</style>
@endsection

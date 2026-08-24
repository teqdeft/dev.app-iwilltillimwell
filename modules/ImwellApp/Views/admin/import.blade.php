@extends('admin.layouts.dashboard')
@section('content')
<div class="main-panel main-wrapper-user">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="patient-details">
                    <div class="media pc-media-box">
                        <div class="title-heading-icon-box-cus"><i class="fas fa-file-upload"></i></div>
                        <div class="media-body theme-title-box">
                            <h3 class="font-weight-bold">Import Users &mdash; {{ $org->name }}</h3>
                            <div class="theme-btn-cont organization-btn-cont">
                                <a href="{{ route('imwell.admin.index') }}" class="btn-custom">
                                    <i class="fas fa-arrow-left"></i> Back to list
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('ImwellApp::admin.partials.flash')

        <div class="row">
            <div class="col-lg-7 grid-margin stretch-card">
                <div class="card card-body">
                    <h4 class="mb-3">Upload member list</h4>

                    <div class="alert alert-info">
                        Every member in this file is linked to
                        <strong>{{ $org->name }}</strong> automatically.
                        You do not need an organization name column in the sheet.
                    </div>

                    <form method="POST" action="{{ route('imwell.admin.import.run', $org->id) }}"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>CSV or Excel file</label>
                            <input type="file" name="sheet" class="form-control-file"
                                   accept=".csv,.xlsx,.xls" required>
                            @error('sheet')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Import members
                        </button>
                        <a href="{{ route('imwell.admin.import.sample') }}" class="btn btn-light">
                            <i class="fas fa-download"></i> Download sample CSV
                        </a>
                    </form>
                </div>
            </div>

            <div class="col-lg-5 grid-margin stretch-card">
                <div class="card card-body">
                    <h4 class="mb-3">Required format</h4>
                    <p class="text-muted small">
                        The first row must be a header row. Column order does not matter &mdash;
                        columns are matched by name.
                    </p>

                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr><th>Column</th><th>Required</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><code>first_name</code></td><td>Yes</td></tr>
                            <tr><td><code>last_name</code></td><td>Yes</td></tr>
                            <tr><td><code>email</code></td><td>Yes</td></tr>
                            <tr><td><code>phone</code></td><td>No</td></tr>
                            <tr><td><code>dob</code></td><td>No</td></tr>
                            <tr><td><code>gender</code></td><td>No</td></tr>
                            <tr><td><code>address</code></td><td>No</td></tr>
                            <tr><td><code>address2</code></td><td>No</td></tr>
                            <tr><td><code>city</code></td><td>No</td></tr>
                            <tr><td><code>state</code></td><td>No</td></tr>
                            <tr><td><code>zip_code</code></td><td>No</td></tr>
                        </tbody>
                    </table>

                    <p class="text-muted small mb-0">
                        Each imported member is emailed a one-time activation link pointing to
                        <code>{{ url('/org/' . $org->slug) }}</code>, where they set their own password.
                        No password is ever generated or emailed.
                    </p>
                </div>
            </div>
        </div>

        @if($result)
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-body">
                    <h4 class="mb-3">Last import result</h4>

                    <p>
                        <span class="badge badge-success">{{ $result['created'] }} imported</span>
                        <span class="badge badge-danger">{{ count($result['skipped']) }} skipped</span>
                    </p>

                    @if(count($result['skipped']))
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr><th>Row</th><th>Email</th><th>Reason skipped</th></tr>
                                </thead>
                                <tbody>
                                @foreach($result['skipped'] as $row)
                                    <tr>
                                        <td>{{ $row['line'] }}</td>
                                        <td>{{ $row['email'] }}</td>
                                        <td class="text-danger">{{ $row['reason'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <p class="text-muted small mb-0">
                            Fix these rows in your sheet and upload again &mdash; members already
                            imported are skipped automatically as duplicates.
                        </p>
                    @endif

                    <a href="{{ route('imwell.admin.import.members', $org->id) }}" class="btn btn-light mt-2">
                        View all members
                    </a>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection

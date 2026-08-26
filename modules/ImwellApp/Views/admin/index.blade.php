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
                                    <h3 class="font-weight-bold">ImWell App Setup</h3>
                                    <div class="theme-btn-cont organization-btn-cont">
                                        <a href="{{ route('imwell.admin.create') }}" class="btn-custom">
                                            <i class="fas fa-user-tag" aria-hidden="true"></i> Create Organization
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
                        <div>
                            <div id="all">

                                <form method="GET" action="{{ route('imwell.admin.index') }}" class="imwell-search">
                                    <input type="text" name="search" value="{{ $search }}" class="form-control"
                                           placeholder="Search by name, link or contact email">
                                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                    @if($search !== '')
                                        <a href="{{ route('imwell.admin.index') }}" class="btn btn-sm btn-light">Clear</a>
                                    @endif
                                </form>

                                <div class="table-responsive pt-3">
                                    <table class="table table-bordered user-table-box" id="imwell-orgs-table">
                                        <thead>
                                            <tr>
                                                <th>Sno.</th>
                                                <th>Name</th>
                                                <th>Link</th>
                                                <th>Status</th>
                                                <th>Logo</th>
                                                <th>Services</th>
                                                <th>Import Users</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($orgs as $i => $org)
                                            <tr>
                                                <td>{{ $orgs->firstItem() + $i }}</td>
                                                <td>
                                                    {{ $org->name }}
                                                    @if($org->contact_email)
                                                        <br><small>{{ $org->contact_email }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a target="_blank" href="{{ $org->landingUrl() }}">{{ $org->slug }}</a>
                                                </td>
                                                <td>{{ $org->status ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    @if($org->logoUrl())
                                                        <a href="{{ $org->logoUrl() }}" target="_blank">
                                                            <img src="{{ $org->logoUrl() }}" alt="{{ $org->name }}">
                                                        </a>
                                                    @else
                                                        &mdash;
                                                    @endif
                                                </td>
                                                <td>
                                                    @php $enabled = $org->enabledFeatureKeys(); @endphp
                                                    @if(count($enabled))
                                                        <ul class="imwell-service-list">
                                                            @foreach($features as $feature)
                                                                @if(in_array($feature['key'], $enabled, true))
                                                                    <li>{{ $feature['label'] }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        &mdash;
                                                    @endif
                                                </td>

                                                {{-- Import Users: same dropdown pattern as Import Subscriber --}}
                                                <td>
                                                    <div class="dropdown uploadSubsSheet">
                                                        <a class="btn btn-custom dropdown-toggle" type="button"
                                                           id="importOrg{{ $org->id }}" data-toggle="dropdown"
                                                           aria-haspopup="true" aria-expanded="false">
                                                            Import Users
                                                        </a>
                                                        <div class="dropdown-menu uploadSbsContainer"
                                                             aria-labelledby="importOrg{{ $org->id }}">
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
                                                    <div class="imwell-member-count">
                                                        <a href="{{ route('imwell.admin.import.members', $org->id) }}">
                                                            {{ $org->members_count }} member(s)
                                                        </a>
                                                    </div>
                                                </td>

                                                <td class="to-show">
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('imwell.admin.edit', $org->id) }}"
                                                               data-toggle="tooltip" title="Edit">
                                                                <label class="badge badge-danger-cus"><i class="fas fa-edit"></i></label>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('imwell.admin.import.form', $org->id) }}"
                                                               data-toggle="tooltip" title="Members and import history">
                                                                <label class="badge badge-danger-cus"><i class="fas fa-user-plus"></i></label>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" data-toggle="tooltip"
                                                               title="{{ $org->status ? 'Deactivate' : 'Activate' }}"
                                                               onclick="document.getElementById('imwell-status-{{ $org->id }}').submit();">
                                                                <label class="badge badge-danger-cus">
                                                                    <i class="fas {{ $org->status ? 'fa-user-times' : 'fa-user-check' }}"></i>
                                                                </label>
                                                            </a>
                                                            <form method="POST" id="imwell-status-{{ $org->id }}"
                                                                  action="{{ route('imwell.admin.status', $org->id) }}"
                                                                  style="display:none">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" data-toggle="tooltip" title="Delete"
                                                               onclick="if(confirm('Delete {{ $org->name }}? This cannot be undone.')) document.getElementById('imwell-del-{{ $org->id }}').submit();">
                                                                <label class="badge badge-danger-cus"><i class="fas fa-trash"></i></label>
                                                            </a>
                                                            <form method="POST" id="imwell-del-{{ $org->id }}"
                                                                  action="{{ route('imwell.admin.delete', $org->id) }}"
                                                                  style="display:none">
                                                                @csrf @method('DELETE')
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    No organizations yet. Use <strong>Create Organization</strong> to add the first one.
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{ $orgs->links() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    /* Match the Corporate listing: small logo, plain bulleted services. */
    #imwell-orgs-table td img { height: 40px; width: auto; object-fit: contain; }
    #imwell-orgs-table .imwell-service-list { margin: 0; padding-left: 16px; }
    #imwell-orgs-table .imwell-service-list li { list-style: disc; }
    #imwell-orgs-table td small { color: #7b8190; }
    #imwell-orgs-table .imwell-member-count { margin-top: 6px; font-size: 12px; }
    #imwell-orgs-table .to-show ul { display: flex; gap: 6px; margin: 0; padding: 0; list-style: none; }
    .imwell-search { display: flex; gap: 8px; align-items: center; max-width: 620px; margin-bottom: 4px; }
</style>
@endsection

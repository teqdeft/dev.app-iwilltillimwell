@extends('admin.layouts.dashboard')
@section('content')
<div class="main-panel main-wrapper-user">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                        <div class="patient-details">
                            <div class="media pc-media-box">
                                <div class="title-heading-icon-box-cus">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="media-body theme-title-box">
                                    <h3 class="font-weight-bold">ImWell App Setup</h3>
                                    <div class="theme-btn-cont organization-btn-cont">
                                        <a href="{{ route('imwell.admin.create') }}" class="btn-custom">
                                            <i class="fas fa-plus" aria-hidden="true"></i> Create Organization
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
                    <div class="all-consultations-box p-3">

                        <form method="GET" action="{{ route('imwell.admin.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="text" name="search" value="{{ $search }}" class="form-control"
                                           placeholder="Search by organization name, slug or contact email">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    @if($search !== '')
                                        <a href="{{ route('imwell.admin.index') }}" class="btn btn-light">Clear</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive pt-3">
                            <table class="table table-bordered user-table-box">
                                <thead>
                                    <tr>
                                        <th>Sno.</th>
                                        <th>Logo</th>
                                        <th>Organization</th>
                                        <th>Member URL</th>
                                        <th>Members</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($orgs as $i => $org)
                                    <tr>
                                        <td>{{ $orgs->firstItem() + $i }}</td>
                                        <td>
                                            @if($org->logoUrl())
                                                <img src="{{ $org->logoUrl() }}" alt="{{ $org->name }}"
                                                     style="height:38px;width:auto;object-fit:contain;">
                                            @else
                                                <span class="text-muted">&mdash;</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $org->name }}</strong>
                                            @if($org->contact_email)
                                                <div class="text-muted small">{{ $org->contact_email }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ $org->url() }}" target="_blank">/org/{{ $org->slug }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('imwell.admin.import.members', $org->id) }}">
                                                {{ $org->members_count }}
                                            </a>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('imwell.admin.status', $org->id) }}">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm {{ $org->status ? 'btn-success' : 'btn-secondary' }}">
                                                    {{ $org->status ? 'Active' : 'Inactive' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('imwell.admin.edit', $org->id) }}"
                                               class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('imwell.admin.import.form', $org->id) }}"
                                               class="btn btn-sm btn-info" title="Import Users">
                                                <i class="fas fa-file-upload"></i> Import Users
                                            </a>
                                            <form method="POST" action="{{ route('imwell.admin.delete', $org->id) }}"
                                                  style="display:inline"
                                                  onsubmit="return confirm('Delete {{ $org->name }}? This cannot be undone.');">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
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
@endsection

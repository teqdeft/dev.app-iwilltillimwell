@extends('admin.layouts.dashboard')
@section('content')
<div class="main-panel main-wrapper-user">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="patient-details">
                    <div class="media pc-media-box">
                        <div class="title-heading-icon-box-cus"><i class="fas fa-users"></i></div>
                        <div class="media-body theme-title-box">
                            <h3 class="font-weight-bold">Members &mdash; {{ $org->name }}</h3>
                            <div class="theme-btn-cont organization-btn-cont">
                                <a href="{{ route('imwell.admin.import.form', $org->id) }}" class="btn-custom">
                                    <i class="fas fa-file-upload"></i> Import Users
                                </a>
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
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered user-table-box">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Account</th>
                                    <th>Imported</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($members as $i => $member)
                                <tr>
                                    <td>{{ $members->firstItem() + $i }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->primaryPhone ?: '-' }}</td>
                                    <td>
                                        @if((int) $member->status === 1)
                                            <span class="badge badge-success">Activated</span>
                                        @else
                                            <span class="badge badge-warning">Pending activation</span>
                                        @endif
                                    </td>
                                    <td>{{ $member->created_at ? $member->created_at->format('m/d/Y') : '-' }}</td>
                                    <td>
                                        @if((int) $member->status !== 1)
                                            <form method="POST"
                                                  action="{{ route('imwell.admin.import.resend', [$org->id, $member->id]) }}"
                                                  style="display:inline">
                                                @csrf
                                                <button class="btn btn-sm btn-info">
                                                    <i class="fas fa-paper-plane"></i> Resend link
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">&mdash;</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        No members imported yet.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $members->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

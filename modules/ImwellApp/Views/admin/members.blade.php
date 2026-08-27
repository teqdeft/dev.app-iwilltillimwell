@extends('admin.layouts.dashboard')
@section('content')
@php use Modules\ImwellApp\Support\Lyric; @endphp
<div class="main-panel main-wrapper-user">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="patient-details ">
                    <div class="media pc-media-box">
                        <div class="title-heading-icon-box-cus"><i class="fas fa-user-tag"></i></div>
                        <div class="media-body theme-title-box">
                            <h3 class="font-weight-bold">Members &mdash; {{ $org->name }}</h3>
                            <div class="theme-btn-cont organization-btn-cont">
                                <a href="{{ route('imwell.admin.import.form', $org->id) }}" class="btn-custom">
                                    <i class="fas fa-file-upload" aria-hidden="true"></i> Import Users
                                </a>
                                <a href="javascript:;" class="btn-custom"
                                   onclick="document.getElementById('imwell-lyric-all').submit();">
                                    <i class="fas fa-notes-medical" aria-hidden="true"></i> Retry Lyric for all
                                </a>
                                <form method="POST" id="imwell-lyric-all"
                                      action="{{ route('imwell.admin.lyric.retry.all', $org->id) }}"
                                      style="display:none">@csrf</form>
                                <a href="{{ route('imwell.admin.index') }}" class="btn-custom">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back to list
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
                    <div class="all-consultations-box  p-3">
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered user-table-box">
                                <thead>
                                    <tr>
                                        <th>Sno.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Account</th>
                                        <th>Telemedicine</th>
                                        <th>Imported</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse($members as $i => $member)
                                    @php
                                        $registered = !empty($member->userid);
                                        $missing    = $registered ? [] : Lyric::missingFields($member);
                                    @endphp
                                    <tr>
                                        <td>{{ $members->firstItem() + $i }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->primaryPhone ?: '-' }}</td>
                                        <td>
                                            @if((int) $member->status === 1)
                                                <label class="badge badge-success">Activated</label>
                                            @else
                                                <label class="badge badge-warning">Pending activation</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if($registered)
                                                <label class="badge badge-success">Registered</label>
                                                <div><small>ID {{ $member->userid }}</small></div>
                                            @elseif($missing)
                                                <label class="badge badge-danger">Missing details</label>
                                                <div><small>{{ implode(', ', $missing) }}</small></div>
                                            @else
                                                <label class="badge badge-warning">Not registered</label>
                                            @endif
                                        </td>
                                        <td>{{ $member->created_at ? $member->created_at->format('m/d/Y') : '-' }}</td>
                                        <td class="to-show">
                                            <ul>
                                                @if((int) $member->status !== 1)
                                                    <li>
                                                        <a href="javascript:;" data-toggle="tooltip" title="Resend activation link"
                                                           onclick="document.getElementById('imwell-resend-{{ $member->id }}').submit();">
                                                            <label class="badge badge-danger-cus"><i class="fas fa-paper-plane"></i></label>
                                                        </a>
                                                        <form method="POST" id="imwell-resend-{{ $member->id }}"
                                                              action="{{ route('imwell.admin.import.resend', [$org->id, $member->id]) }}"
                                                              style="display:none">@csrf</form>
                                                    </li>
                                                @endif
                                                @if(! $registered)
                                                    <li>
                                                        <a href="javascript:;" data-toggle="tooltip" title="Register on Lyric"
                                                           onclick="document.getElementById('imwell-lyric-{{ $member->id }}').submit();">
                                                            <label class="badge badge-danger-cus"><i class="fas fa-notes-medical"></i></label>
                                                        </a>
                                                        <form method="POST" id="imwell-lyric-{{ $member->id }}"
                                                              action="{{ route('imwell.admin.lyric.retry', [$org->id, $member->id]) }}"
                                                              style="display:none">@csrf</form>
                                                    </li>
                                                @endif
                                                @if((int) $member->status === 1 && $registered)
                                                    <li>&mdash;</li>
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No members imported yet.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $members->links() }}

                        <p class="imwell-note">
                            <strong>Telemedicine</strong> shows whether the member exists on Lyric, which
                            consultations, health records and lab reports depend on. Registration happens
                            automatically when a member activates and is retried on their next sign in;
                            use the retry action if a member is stuck. "Missing details" means the sheet did
                            not supply everything Lyric requires &mdash; fill those in and retry.
                        </p>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .imwell-note { font-size: 13px; color: #7b8190; margin: 14px 0 0; line-height: 1.7; }
    .user-table-box .to-show ul { display: flex; gap: 6px; margin: 0; padding: 0; list-style: none; }
    .user-table-box td small { color: #7b8190; }
</style>
@endsection

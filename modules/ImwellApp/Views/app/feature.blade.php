@extends('ImwellApp::app.layout')
@section('title', $feature['label'] . ' - ' . $org->name)

@section('content')
    <div class="org-card">
        <h1><i class="{{ $feature['icon'] }}" style="color:var(--org-primary)"></i> {{ $feature['label'] }}</h1>
        <p class="sub">{{ $org->name }}</p>

        <div style="border-top:1px solid #eef0f4;padding-top:20px;color:#6b7280;font-size:14px;line-height:1.7">
            <p style="margin:0 0 8px">
                This feature is enabled for your organization. The screen for
                <strong>{{ $feature['label'] }}</strong> has not been built out yet.
            </p>
            <p style="margin:0">
                To supply a real screen, add
                <code>Views/app/features/{{ str_replace('-', '_', $feature['page']) }}.blade.php</code>
                to the ImwellApp module &mdash; it will be picked up automatically.
            </p>
        </div>
    </div>
@endsection

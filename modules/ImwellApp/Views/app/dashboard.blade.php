@extends('ImwellApp::app.layout')
@section('title', 'Home - ' . $org->name)

@section('content')
    <div class="org-card">
        <h1>Welcome, {{ auth()->user()->fname }}</h1>
        <p class="sub">
            You are signed in to the {{ $org->name }} member area.
        </p>

        @if($org->description)
            <div style="border-top:1px solid #eef0f4;padding-top:18px;line-height:1.7;font-size:14px">
                {!! $org->description !!}
            </div>
        @endif
    </div>

    <div class="org-card" style="margin-top:20px">
        <h1 style="font-size:17px">Available to you</h1>
        <p class="sub">These are the services {{ $org->name }} has enabled for members.</p>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:12px">
            @foreach($nav as $item)
                @continue($item['key'] === 'dashboard')
                <a href="{{ route('imwell.org.page', [$org->slug, $item['page']]) }}"
                   style="display:flex;align-items:center;gap:11px;padding:15px;border:1px solid #eef0f4;
                          border-radius:10px;text-decoration:none;color:#2f3440;font-size:14px;
                          transition:.15s;background:#fcfcfd"
                   onmouseover="this.style.borderColor='{{ $org->primary_color ?: '#994c8d' }}'"
                   onmouseout="this.style.borderColor='#eef0f4'">
                    <i class="{{ $item['icon'] }}" style="color:{{ $org->primary_color ?: '#994c8d' }}"></i>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        @if(count($nav) <= 1)
            <p style="color:#9aa0ab;font-size:14px;margin:0">
                No additional services have been enabled for your organization yet.
            </p>
        @endif
    </div>
@endsection

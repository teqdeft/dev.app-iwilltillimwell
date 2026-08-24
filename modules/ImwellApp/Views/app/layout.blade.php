<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $org->name)</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root { --org-primary: {{ $org->primary_color ?: '#994c8d' }}; }
        *,*::before,*::after{box-sizing:border-box}
        body{margin:0;font-family:'Open Sans','Helvetica Neue',Arial,sans-serif;background:#f5f6f8;color:#2f3440}
        .org-topbar{background:var(--org-primary);color:#fff;padding:0 22px;display:flex;align-items:center;
            justify-content:space-between;height:64px;position:sticky;top:0;z-index:20}
        .org-brand{display:flex;align-items:center;gap:12px;min-width:0}
        .org-brand img{height:38px;max-width:150px;object-fit:contain;background:#fff;border-radius:8px;padding:4px}
        .org-brand span{font-weight:600;font-size:16px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .org-user{display:flex;align-items:center;gap:14px;font-size:13px}
        .org-user form{margin:0}
        .org-logout{background:rgba(255,255,255,.16);color:#fff;border:0;border-radius:7px;padding:8px 14px;
            font-size:13px;cursor:pointer;transition:.15s}
        .org-logout:hover{background:rgba(255,255,255,.28)}
        .org-shell{display:flex;align-items:flex-start;gap:22px;max-width:1220px;margin:22px auto;padding:0 20px}
        .org-nav{flex:0 0 236px;background:#fff;border-radius:12px;padding:10px;
            box-shadow:0 2px 12px rgba(20,20,43,.06)}
        .org-nav a{display:flex;align-items:center;gap:11px;padding:11px 13px;border-radius:8px;
            color:#4b5162;text-decoration:none;font-size:14px;transition:.15s}
        .org-nav a:hover{background:#f2f3f7;color:#22252e}
        .org-nav a.active{background:var(--org-primary);color:#fff}
        .org-nav a i{width:18px;text-align:center;font-size:15px}
        .org-main{flex:1;min-width:0}
        .org-card{background:#fff;border-radius:12px;padding:26px 28px;box-shadow:0 2px 12px rgba(20,20,43,.06)}
        .org-card h1{margin:0 0 6px;font-size:21px;font-weight:600}
        .org-card .sub{margin:0 0 20px;color:#6b7280;font-size:14px}
        .alert-ok{background:#e9f7ef;color:#1a7442;border:1px solid #c3e9d4;padding:11px 14px;
            border-radius:9px;font-size:13px;margin-bottom:18px}
        @media(max-width:860px){
            .org-shell{flex-direction:column}
            .org-nav{flex:1 1 auto;width:100%;display:flex;flex-wrap:wrap;gap:6px}
            .org-nav a{flex:1 1 auto;justify-content:center}
        }
    </style>
</head>
<body>

<div class="org-topbar">
    <div class="org-brand">
        @if($org->logoUrl())
            <img src="{{ $org->logoUrl() }}" alt="{{ $org->name }} logo">
        @endif
        <span>{{ $org->name }}</span>
    </div>
    <div class="org-user">
        <span>{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('imwell.org.logout', $org->slug) }}">
            @csrf
            <button type="submit" class="org-logout">Sign out</button>
        </form>
    </div>
</div>

<div class="org-shell">
    <nav class="org-nav">
        @foreach($nav as $item)
            @php
                $url = $item['key'] === 'dashboard'
                    ? route('imwell.org.home', $org->slug)
                    : route('imwell.org.page', [$org->slug, $item['page']]);
                $isActive = $item['key'] === 'dashboard'
                    ? request()->routeIs('imwell.org.home')
                    : request()->route('page') === $item['page'];
            @endphp
            <a href="{{ $url }}" class="{{ $isActive ? 'active' : '' }}">
                <i class="{{ $item['icon'] }}"></i> {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    <main class="org-main">
        @if(session('success'))
            <div class="alert-ok">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
</div>

</body>
</html>

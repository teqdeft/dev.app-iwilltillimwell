<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $org->name)</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <style>
        :root { --org-primary: {{ $org->primary_color ?: '#994c8d' }}; }
        *,*::before,*::after{box-sizing:border-box}
        body{margin:0;font-family:'Open Sans','Helvetica Neue',Arial,sans-serif;background:#f5f6f8;color:#2f3440;
            min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}
        .org-card{width:100%;max-width:420px;background:#fff;border-radius:14px;
            box-shadow:0 10px 40px rgba(20,20,43,.10);overflow:hidden}
        .org-head{background:var(--org-primary);color:#fff;padding:28px 28px 24px;text-align:center}
        .org-head img{max-height:64px;max-width:200px;object-fit:contain;background:#fff;
            border-radius:10px;padding:8px;margin-bottom:12px}
        .org-head h1{margin:0;font-size:20px;font-weight:600;line-height:1.35}
        .org-head p{margin:6px 0 0;font-size:13px;opacity:.9}
        .org-body{padding:26px 28px 30px}
        .org-body h2{margin:0 0 4px;font-size:17px;font-weight:600}
        .org-body .sub{margin:0 0 20px;font-size:13px;color:#6b7280}
        label{display:block;font-size:13px;font-weight:600;margin-bottom:6px}
        .field{margin-bottom:16px}
        input[type=email],input[type=password],input[type=text]{width:100%;padding:11px 13px;font-size:14px;
            border:1px solid #dfe3e8;border-radius:8px;background:#fff;outline:none;transition:.15s}
        input:focus{border-color:var(--org-primary);box-shadow:0 0 0 3px rgba(0,0,0,.06)}
        .btn{width:100%;padding:12px;font-size:15px;font-weight:600;color:#fff;background:var(--org-primary);
            border:0;border-radius:8px;cursor:pointer;transition:.15s}
        .btn:hover{filter:brightness(.93)}
        .alert{padding:11px 13px;border-radius:8px;font-size:13px;margin-bottom:16px;line-height:1.5}
        .alert-error{background:#fdeced;color:#a3212c;border:1px solid #f6c9cd}
        .alert-ok{background:#e9f7ef;color:#1a7442;border:1px solid #c3e9d4}
        .muted{font-size:12px;color:#9aa0ab;text-align:center;margin:18px 0 0;line-height:1.6}
        .remember{display:flex;align-items:center;gap:8px;font-size:13px;font-weight:400;margin-bottom:18px}
        .remember input{margin:0}
        .hint{font-size:12px;color:#6b7280;margin-top:6px}
    </style>
</head>
<body>
    <div class="org-card">
        <div class="org-head">
            @if($org->logoUrl())
                <img src="{{ $org->logoUrl() }}" alt="{{ $org->name }} logo">
            @endif
            <h1>{{ $org->name }}</h1>
            <p>Powered by iWILL &lsquo;til i&rsquo;mWELL</p>
        </div>

        <div class="org-body">
            @if(session('success'))
                <div class="alert alert-ok">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>

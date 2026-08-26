<?php use Showcase\View; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= View::e($title ?? 'iMWELL') ?></title>
    <style>
        :root{
            --brand: <?= View::e($org['primary_color'] ?? '#994c8d') ?>;
            --ink:#22252e; --muted:#6b7280; --line:#e8eaef; --bg:#f5f6f8;
        }
        *,*::before,*::after{box-sizing:border-box}
        body{margin:0;font-family:'Open Sans','Helvetica Neue',Arial,sans-serif;color:var(--ink);
            background:var(--bg);line-height:1.6}
        a{color:var(--brand)}
        .wrap{max-width:1080px;margin:0 auto;padding:0 22px}

        header.site{background:#fff;border-bottom:1px solid var(--line);position:sticky;top:0;z-index:20}
        header.site .wrap{display:flex;align-items:center;justify-content:space-between;
            min-height:70px;gap:16px}
        .brand{display:flex;align-items:center;gap:12px;min-width:0;text-decoration:none;color:var(--ink)}
        .brand img{height:40px;max-width:170px;object-fit:contain}
        .brand strong{font-size:17px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .navlinks{display:flex;align-items:center;gap:12px;font-size:14px}
        .navlinks form{margin:0}

        .btn{display:inline-block;padding:11px 20px;border-radius:9px;border:0;cursor:pointer;
            font-size:14px;font-weight:600;text-decoration:none;background:var(--brand);color:#fff;
            transition:.15s;font-family:inherit}
        .btn:hover{filter:brightness(.92)}
        .btn.ghost{background:transparent;color:var(--brand);border:1px solid var(--brand)}
        .btn.block{display:block;width:100%;text-align:center}

        .hero{background:#fff;border-bottom:1px solid var(--line);padding:56px 0}
        .hero-inner{display:flex;gap:32px;align-items:center;flex-wrap:wrap}
        .hero-logo{flex:0 0 auto;width:128px;height:128px;border-radius:18px;background:#fff;
            border:1px solid var(--line);display:flex;align-items:center;justify-content:center;padding:14px}
        .hero-logo img{max-width:100%;max-height:100%;object-fit:contain}
        .hero-text{flex:1;min-width:280px}
        .hero-text h1{margin:0 0 10px;font-size:31px;line-height:1.25}
        .eyebrow{display:inline-block;font-size:12px;letter-spacing:.09em;text-transform:uppercase;
            color:var(--brand);font-weight:700;margin-bottom:10px}
        .lead{color:var(--muted);font-size:16px;margin:0 0 20px}
        .cta-row{display:flex;gap:10px;flex-wrap:wrap}

        section.block{padding:46px 0}
        section.block h2{font-size:22px;margin:0 0 6px}
        section.block .sub{color:var(--muted);margin:0 0 24px;font-size:15px}

        .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(268px,1fr));gap:16px}
        .card{background:#fff;border:1px solid var(--line);border-radius:13px;padding:20px;
            text-decoration:none;color:inherit;display:block;transition:.15s}
        a.card:hover{border-color:var(--brand);transform:translateY(-2px)}
        .card h3{margin:0 0 6px;font-size:16px}
        .card p{margin:0;color:var(--muted);font-size:14px}
        .card .card-logo{height:38px;margin-bottom:12px;display:flex;align-items:center}
        .card .card-logo img{max-height:38px;max-width:150px;object-fit:contain}

        .panel{background:#fff;border:1px solid var(--line);border-radius:13px;padding:26px}
        .panel h2{margin-top:0}

        .authwrap{min-height:calc(100vh - 70px);display:flex;align-items:center;justify-content:center;padding:40px 22px}
        .authcard{width:100%;max-width:430px;background:#fff;border:1px solid var(--line);
            border-radius:14px;overflow:hidden}
        .authcard .head{background:var(--brand);color:#fff;padding:26px;text-align:center}
        .authcard .head img{max-height:56px;max-width:190px;object-fit:contain;background:#fff;
            border-radius:9px;padding:7px;margin-bottom:10px}
        .authcard .head h1{margin:0;font-size:19px;font-weight:600}
        .authcard .body{padding:26px}
        label{display:block;font-size:13px;font-weight:600;margin-bottom:6px}
        .field{margin-bottom:16px}
        input[type=email],input[type=password],input[type=text]{width:100%;padding:11px 13px;
            font-size:14px;border:1px solid #dfe3e8;border-radius:8px;font-family:inherit}
        input:focus{outline:none;border-color:var(--brand);box-shadow:0 0 0 3px rgba(0,0,0,.06)}
        input[disabled]{background:#f6f7f9;color:var(--muted)}

        .alert{padding:11px 13px;border-radius:8px;font-size:13px;margin-bottom:16px}
        .alert-error{background:#fdeced;color:#a3212c;border:1px solid #f6c9cd}
        .alert-ok{background:#e9f7ef;color:#1a7442;border:1px solid #c3e9d4}
        .hint{font-size:12px;color:var(--muted);margin-top:6px}
        .muted{font-size:12.5px;color:var(--muted);text-align:center;margin:18px 0 0}

        footer.site{border-top:1px solid var(--line);background:#fff;padding:26px 0;margin-top:20px}
        footer.site .wrap{display:flex;justify-content:space-between;gap:14px;flex-wrap:wrap;
            font-size:13px;color:var(--muted)}
        @media(max-width:640px){ .hero{padding:38px 0} .hero-text h1{font-size:25px} }
    </style>
</head>
<body>

<header class="site">
    <div class="wrap">
        <?php if (! empty($org)): ?>
            <a class="brand" href="/<?= View::e($org['slug']) ?>">
                <?php if ($logo = View::logoUrl($org['logo'] ?? null)): ?>
                    <img src="<?= View::e($logo) ?>" alt="<?= View::e($org['name']) ?>">
                <?php endif; ?>
                <strong><?= View::e($org['name']) ?></strong>
            </a>
        <?php else: ?>
            <a class="brand" href="/"><strong>iMWELL</strong></a>
        <?php endif; ?>

        <div class="navlinks">
            <?php if (! empty($org) && ! empty($member)): ?>
                <span><?= View::e($member['fname'] ?: $member['name']) ?></span>
                <form method="POST" action="/<?= View::e($org['slug']) ?>/logout">
                    <input type="hidden" name="_token" value="<?= View::e($csrf) ?>">
                    <button type="submit" class="btn ghost">Sign out</button>
                </form>
            <?php elseif (! empty($org)): ?>
                <a class="btn ghost" href="/<?= View::e($org['slug']) ?>/login">Sign in</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<?= $content ?>

<footer class="site">
    <div class="wrap">
        <span>&copy; <?= date('Y') ?> iWILL &lsquo;til i&rsquo;mWELL. All rights reserved.</span>
        <span>Questions? <a href="mailto:support@iwilltilimwell.com">support@iwilltilimwell.com</a></span>
    </div>
</footer>

</body>
</html>

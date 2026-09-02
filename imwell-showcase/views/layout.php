<?php use Showcase\View; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="referrer" content="same-origin">
    <title><?= View::e($title ?? 'iMWELL') ?></title>
    <style>
        :root{
            --brand: <?= View::e($org['primary_color'] ?? '#994c8d') ?>;
            --ink:#22252e; --muted:#6b7280; --line:#e8eaef; --bg:#f5f6f8;
            --ok:#1f7a4d; --ok-bg:#e8f6ee;
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

        .btn{display:inline-block;padding:11px 20px;border-radius:9px;border:0;cursor:pointer;
            font-size:14px;font-weight:600;text-decoration:none;background:var(--brand);color:#fff;
            transition:.15s;font-family:inherit;text-align:center}
        .btn:hover{filter:brightness(.92)}
        .btn.ghost{background:transparent;color:var(--brand);border:1px solid var(--brand)}
        .btn.lg{padding:14px 30px;font-size:15px}
        .btn.block{display:block;width:100%}

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
        .cta-row{display:flex;gap:10px;flex-wrap:wrap;align-items:center}
        .hint{font-size:12.5px;color:var(--muted);margin:10px 0 0}

        section.block{padding:46px 0}
        section.block h2{font-size:22px;margin:0 0 6px}
        section.block .sub{color:var(--muted);margin:0 0 24px;font-size:15px}

        .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:16px}
        .card{background:#fff;border:1px solid var(--line);border-radius:13px;padding:22px;
            text-decoration:none;color:inherit;display:block}
        .card h3{margin:0 0 6px;font-size:16px}
        .card p{margin:0;color:var(--muted);font-size:14px}
        .card ul{margin:12px 0 0;padding:0 0 0 18px;color:var(--muted);font-size:13.5px}
        .card ul li{margin:0 0 4px}
        .card .open{display:inline-block;margin-top:14px;font-size:13.5px;font-weight:600;
            color:var(--brand);text-decoration:none}

        .panel{background:#fff;border:1px solid var(--line);border-radius:13px;padding:26px}
        .panel h2{margin-top:0}

        .notice{display:flex;gap:10px;align-items:flex-start;background:var(--ok-bg);color:var(--ok);
            border-radius:11px;padding:14px 18px;font-size:14px;font-weight:600;margin:0 0 22px}

        /* Activation form */
        .formwrap{max-width:460px;margin:52px auto;padding:0 22px}
        .formcard{background:#fff;border:1px solid var(--line);border-radius:15px;padding:32px}
        .formcard .logo{text-align:center;margin:0 0 18px}
        .formcard .logo img{max-height:56px;max-width:190px;object-fit:contain}
        .formcard h1{font-size:22px;margin:0 0 6px;text-align:center}
        .formcard .sub{color:var(--muted);font-size:14px;text-align:center;margin:0 0 24px}
        .field{margin:0 0 16px}
        .field label{display:block;font-size:13px;font-weight:600;margin:0 0 6px}
        .field input{width:100%;padding:12px 14px;border:1px solid var(--line);border-radius:9px;
            font-size:15px;font-family:inherit;background:#fff;color:var(--ink)}
        .field input:focus{outline:2px solid var(--brand);outline-offset:1px;border-color:var(--brand)}
        .field input[readonly]{background:#f3f4f7;color:var(--muted)}
        .field .help{font-size:12.5px;color:var(--muted);margin:6px 0 0}
        .alert{background:#fdecee;color:#a3212c;border-radius:9px;padding:12px 14px;
            font-size:13.5px;margin:0 0 18px}
        .formcard .foot{text-align:center;font-size:12.5px;color:var(--muted);margin:18px 0 0}

        footer.site{border-top:1px solid var(--line);background:#fff;padding:26px 0;margin-top:20px}
        footer.site .wrap{display:flex;justify-content:space-between;gap:14px;flex-wrap:wrap;
            font-size:13px;color:var(--muted)}
        @media(max-width:640px){ .hero{padding:38px 0} .hero-text h1{font-size:25px} }
    </style>
</head>
<body>

<header class="site">
    <div class="wrap">
        <?php if (! empty($org['slug'])): ?>
            <a class="brand" href="<?= View::e(View::orgUrl($org['slug'])) ?>">
                <?php if (! empty($org['logo_url'])): ?>
                    <img src="<?= View::e($org['logo_url']) ?>" alt="<?= View::e($org['name'] ?? '') ?>">
                <?php endif; ?>
                <strong><?= View::e($org['name'] ?? '') ?></strong>
            </a>
        <?php else: ?>
            <span class="brand"><strong>iMWELL</strong></span>
        <?php endif; ?>

        <?php if (! empty($org['slug']) && empty($hideNav)): ?>
            <div class="navlinks">
                <a class="btn ghost" href="<?= View::e(View::memberAppUrl($org['slug'], $ticket ?? null)) ?>">
                    Go to the app
                </a>
            </div>
        <?php endif; ?>
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

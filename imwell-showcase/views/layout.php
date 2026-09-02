<?php
use Showcase\Brand;
use Showcase\View;

// The organization's colour when the admin set one, otherwise the product
// purple - so an org with no colour still looks native rather than washed out
// by some invented default.
$brandColor = Brand::orgColor($org ?? null);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="referrer" content="same-origin">
    <title><?= View::e($title ?? Brand::name()) ?></title>
    <?php if ($favicon = Brand::faviconUrl()): ?>
        <link rel="icon" href="<?= View::e($favicon) ?>">
    <?php endif; ?>

    <?php /* Inter - the same face the application's login screen loads. */ ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300..800&display=swap" rel="stylesheet">

    <style>
        :root{
            /* Product palette - mirrors new-login-style.css on the main app. */
            --app:<?= View::e(Brand::primary()) ?>;
            --accent:<?= View::e(Brand::accent()) ?>;
            /* This organization's accent. */
            --brand:<?= View::e($brandColor) ?>;

            --ink:#272727; --body:#575757; --muted:#797575;
            --line:#E4E4E4; --bg:#f7f6f9; --card:#fff;
            --ok:#1f7a4d; --ok-bg:#eaf7f0; --err:#a3212c; --err-bg:#fdecee;

            --r-card:16px; --r-ctl:10px;
            --shadow:0 1px 2px rgba(39,39,39,.04), 0 8px 26px rgba(39,39,39,.07);
            --shadow-lg:0 2px 6px rgba(39,39,39,.05), 0 22px 60px rgba(39,39,39,.13);
        }
        *,*::before,*::after{box-sizing:border-box}
        html{-webkit-text-size-adjust:100%}
        body{
            margin:0;min-height:100vh;display:flex;flex-direction:column;
            background:var(--bg);color:var(--ink);line-height:1.6;
            font-family:"Inter",-apple-system,"Segoe UI",sans-serif;
            font-optical-sizing:auto;font-weight:400;-webkit-font-smoothing:antialiased;
        }
        img{max-width:100%}
        a{color:var(--brand);text-decoration:none}
        a:hover{text-decoration:underline}
        h1,h2,h3{color:var(--ink);letter-spacing:-.02em;margin:0}
        .wrap{max-width:1120px;margin:0 auto;padding:0 24px;width:100%}
        main{flex:1}
        main.fill{display:flex;flex-direction:column}

        /* ---------- buttons: the application's .custom-cta ---------- */
        .btn{
            display:inline-flex;align-items:center;justify-content:center;gap:9px;
            font:500 16px/26px "Inter",sans-serif;padding:11px 34px;
            border:1px solid var(--brand);border-radius:var(--r-ctl);
            background:var(--brand);color:#fff;cursor:pointer;
            transition:all 200ms ease-in;text-align:center;
        }
        .btn:hover{background:var(--accent);border-color:var(--accent);color:#fff;text-decoration:none}
        .btn.ghost{background:transparent;color:var(--brand)}
        .btn.ghost:hover{background:var(--brand);color:#fff}
        .btn.on-dark{background:#fff;border-color:#fff;color:var(--brand)}
        .btn.on-dark:hover{background:rgba(255,255,255,.88);border-color:transparent}
        .btn.outline-light{background:transparent;border-color:rgba(255,255,255,.55);color:#fff}
        .btn.outline-light:hover{background:rgba(255,255,255,.14);border-color:#fff}
        .btn.block{display:flex;width:100%}
        .btn.sm{font-size:14px;line-height:22px;padding:8px 20px}
        .btn svg{flex:0 0 auto}

        /* ---------- header ---------- */
        header.site{background:#fff;border-bottom:1px solid var(--line);position:sticky;top:0;z-index:30}
        header.site .wrap{display:flex;align-items:center;justify-content:space-between;gap:18px;min-height:76px}
        .ident{display:flex;align-items:center;gap:14px;min-width:0;color:var(--ink)}
        .ident:hover{text-decoration:none}
        .ident .mark{height:34px;width:34px;object-fit:contain;flex:0 0 auto}
        .ident .wordmark{font-size:23px;font-weight:700;letter-spacing:-.035em;
            color:var(--app);line-height:1;flex:0 0 auto}
        .ident .rule{width:1px;height:30px;background:var(--line);flex:0 0 auto}
        .ident .orglogo{max-height:38px;max-width:150px;object-fit:contain;flex:0 0 auto}
        .ident .orgname{font-size:16px;font-weight:600;white-space:nowrap;overflow:hidden;
            text-overflow:ellipsis;letter-spacing:-.01em}

        /* ---------- hero ---------- */
        .hero{position:relative;overflow:hidden;background:var(--brand);color:#fff;padding:76px 0 84px}
        .hero::after{content:"";position:absolute;inset:0;pointer-events:none;
            background:
              radial-gradient(circle at 12% 18%, rgba(255,255,255,.20), transparent 46%),
              radial-gradient(circle at 88% 6%, rgba(255,255,255,.13), transparent 42%),
              linear-gradient(160deg, rgba(255,255,255,.10), rgba(0,0,0,.22));}
        .hero>*{position:relative;z-index:2}
        .hero-grid{display:grid;grid-template-columns:1.35fr .9fr;gap:52px;align-items:center}
        .eyebrow{display:inline-flex;align-items:center;gap:8px;font-size:12px;font-weight:600;
            letter-spacing:.12em;text-transform:uppercase;background:rgba(255,255,255,.16);
            border:1px solid rgba(255,255,255,.26);padding:7px 15px;border-radius:999px;margin-bottom:20px}
        .hero h1{font-size:clamp(30px,4.4vw,49px);line-height:1.1;font-weight:700;color:#fff;margin:0 0 18px}
        .hero .lead{font-size:17px;color:rgba(255,255,255,.9);margin:0 0 30px;max-width:57ch}
        .hero .lead p{margin:0 0 10px}
        .hero .lead a{color:#fff;text-decoration:underline}
        .cta-row{display:flex;gap:12px;flex-wrap:wrap;align-items:center}
        .hero .hint{font-size:13px;color:rgba(255,255,255,.72);margin:16px 0 0}

        /* organization logo plate */
        .orgplate{background:#fff;border-radius:22px;padding:34px;text-align:center;box-shadow:var(--shadow-lg)}
        .orgplate img{max-height:112px;max-width:100%;object-fit:contain}
        .orgplate .fallback{font-size:26px;font-weight:700;color:var(--brand);letter-spacing:-.02em}
        .orgplate .cap{display:block;margin-top:16px;padding-top:15px;border-top:1px solid var(--line);
            font-size:11.5px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--muted)}

        /* ---------- sections ---------- */
        section.block{padding:66px 0}
        section.block.tight{padding-top:0}
        .headline{max-width:640px;margin:0 0 36px}
        .headline.mid{margin-left:auto;margin-right:auto;text-align:center}
        .headline h2{font-size:clamp(23px,2.7vw,31px);font-weight:700;line-height:1.22;margin:0 0 12px}
        .headline p{color:var(--body);font-size:16px;margin:0}

        /* ---------- cards ---------- */
        .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(310px,1fr));gap:22px}
        .card{background:var(--card);border:1px solid var(--line);border-radius:var(--r-card);
            padding:28px;transition:transform .18s ease,box-shadow .18s ease,border-color .18s ease}
        .card:hover{transform:translateY(-3px);box-shadow:var(--shadow);border-color:transparent}
        .card .ico{width:50px;height:50px;border-radius:14px;display:flex;align-items:center;
            justify-content:center;margin-bottom:18px;color:var(--brand);
            background:rgba(39,39,39,.055);
            background:color-mix(in srgb, var(--brand) 12%, #fff)}
        .card h3{font-size:17.5px;font-weight:600;margin:0 0 9px}
        .card p{margin:0;color:var(--body);font-size:14.5px}
        .card ul{list-style:none;margin:16px 0 0;padding:0}
        .card ul li{position:relative;padding-left:24px;margin:0 0 8px;font-size:14px;color:var(--body)}
        .card ul li::before{content:"";position:absolute;left:2px;top:7px;width:12px;height:7px;
            border-left:2px solid var(--brand);border-bottom:2px solid var(--brand);
            transform:rotate(-45deg);border-radius:1px}
        .card .open{display:inline-flex;align-items:center;gap:6px;margin-top:18px;
            font-size:14px;font-weight:600;color:var(--brand);transition:gap .15s ease}
        .card .open:hover{gap:11px;text-decoration:none}

        /* ---------- numbered steps ---------- */
        .steps{display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:26px;counter-reset:step}
        .step{position:relative;padding-top:52px}
        .step::before{counter-increment:step;content:counter(step);position:absolute;top:0;left:0;
            width:38px;height:38px;border-radius:50%;display:flex;align-items:center;justify-content:center;
            font-size:15px;font-weight:700;color:#fff;background:var(--brand)}
        .step h3{font-size:16.5px;font-weight:600;margin:0 0 7px}
        .step p{margin:0;color:var(--body);font-size:14.5px}

        /* ---------- banner ---------- */
        .banner{background:var(--brand);border-radius:22px;padding:52px 40px;text-align:center;
            color:#fff;position:relative;overflow:hidden}
        .banner::after{content:"";position:absolute;inset:0;pointer-events:none;
            background:radial-gradient(circle at 20% 0%, rgba(255,255,255,.18), transparent 55%)}
        .banner>*{position:relative;z-index:2}
        .banner h2{color:#fff;font-size:clamp(22px,2.5vw,29px);font-weight:700;margin:0 0 12px}
        .banner p{color:rgba(255,255,255,.9);max-width:560px;margin:0 auto 26px;font-size:15.5px}
        .banner .sub{font-size:13px;color:rgba(255,255,255,.72);margin:18px 0 0}

        /* ---------- notice ---------- */
        .notice{display:flex;gap:13px;align-items:flex-start;background:var(--ok-bg);color:var(--ok);
            border:1px solid rgba(31,122,77,.2);border-radius:var(--r-ctl);padding:15px 19px;
            font-size:14.5px;font-weight:500;margin:0 0 30px}
        .notice svg{flex:0 0 auto;margin-top:3px}
        .notice.on-hero{background:rgba(255,255,255,.15);color:#fff;border-color:rgba(255,255,255,.32)}

        /* ---------- panels and facts ---------- */
        .panel{background:var(--card);border:1px solid var(--line);border-radius:var(--r-card);padding:30px}
        .facts{display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:1px;
            background:var(--line);border:1px solid var(--line);border-radius:var(--r-card);overflow:hidden}
        .fact{background:#fff;padding:26px 24px}
        .fact .n{font-size:29px;font-weight:700;color:var(--brand);letter-spacing:-.03em;line-height:1.15}
        .fact .l{font-size:13.5px;color:var(--body);margin-top:5px}

        /* ---------- split auth screen (mirrors the app's login) ---------- */
        .auth{flex:1;display:grid;grid-template-columns:1.05fr .95fr}
        .auth-art{position:relative;background:var(--brand) center/cover no-repeat;overflow:hidden;min-height:100%}
        .auth-art::after{content:"";position:absolute;inset:0;
            background:linear-gradient(to bottom, rgba(0,0,0,.18) 0%, rgba(0,0,0,.10) 45%, rgba(0,0,0,.62) 100%)}
        .auth-art .quote{position:absolute;z-index:2;left:52px;right:52px;bottom:52px;color:#fff}
        .auth-art .quote strong{display:block;font-size:25px;font-weight:600;line-height:1.32;
            letter-spacing:-.02em;margin-bottom:10px}
        .auth-art .quote span{font-size:14.5px;color:rgba(255,255,255,.84)}
        .auth-form{display:flex;align-items:center;justify-content:center;padding:48px 26px;background:#fff}
        .authcard{width:100%;max-width:412px}
        .authcard .logos{display:flex;align-items:center;justify-content:center;gap:16px;margin-bottom:26px}
        .authcard .logos img.org{max-height:66px;max-width:190px;object-fit:contain}
        .authcard .logos img.mark{height:34px;width:34px;object-fit:contain}
        .authcard .logos .wordmark{font-size:21px;font-weight:700;letter-spacing:-.035em;
            color:var(--app);line-height:1}
        .authcard .lockup{display:flex;align-items:center;justify-content:center;gap:9px}
        .authcard .logos .rule{width:1px;height:34px;background:var(--line)}
        .authcard h1{font-size:25px;font-weight:700;line-height:1.25;margin:0 0 8px;text-align:center}
        .authcard .sub{color:var(--body);font-size:14.5px;text-align:center;margin:0 0 28px}

        .field{margin:0 0 17px}
        .field label{display:block;font-size:13.5px;font-weight:500;color:var(--ink);margin:0 0 7px}
        .field .box{position:relative}
        .field input{width:100%;padding:13px 16px;border:1px solid var(--line);border-radius:var(--r-ctl);
            font:400 16px/26px "Inter",sans-serif;color:var(--ink);background:#fff;
            transition:border-color .15s,box-shadow .15s}
        .field input:focus{outline:0;border-color:var(--brand);
            box-shadow:0 0 0 3px rgba(39,39,39,.12);
            box-shadow:0 0 0 3px color-mix(in srgb, var(--brand) 24%, transparent)}
        .field input[readonly]{background:#f6f5f8;color:var(--muted)}
        .field input.has-toggle{padding-right:48px}
        .field .toggle{position:absolute;right:6px;top:50%;transform:translateY(-50%);background:none;
            border:0;cursor:pointer;padding:9px;color:var(--muted);display:flex;align-items:center;border-radius:8px}
        .field .toggle:hover{color:var(--brand);background:#f6f5f8}
        .field .help{font-size:12.5px;color:var(--muted);margin:7px 0 0}

        .meter{height:4px;border-radius:99px;background:var(--line);overflow:hidden;
            margin:10px 0 0;opacity:0;transition:opacity .2s ease}
        .meter.on{opacity:1}
        .meter i{display:block;height:100%;width:0;border-radius:99px;background:var(--brand);
            transition:width .25s ease}
        .meter-label{font-size:12.5px;color:var(--muted);margin:7px 0 0;min-height:19px}

        .alert{background:var(--err-bg);color:var(--err);border:1px solid rgba(163,33,44,.18);
            border-radius:var(--r-ctl);padding:13px 16px;font-size:13.5px;margin:0 0 20px}
        .authcard .foot{text-align:center;font-size:12.5px;color:var(--muted);margin:22px 0 0;line-height:1.7}

        /* ---------- footer ---------- */
        footer.site{background:#fff;border-top:1px solid var(--line);padding:34px 0}
        footer.site .wrap{display:flex;justify-content:space-between;align-items:center;gap:18px;
            flex-wrap:wrap;font-size:13.5px;color:var(--muted)}

        /* ---------- responsive ---------- */
        @media(max-width:900px){
            .hero-grid{grid-template-columns:1fr;gap:36px}
            .orgplate{max-width:330px}
            .auth{grid-template-columns:1fr}
            .auth-art{display:none}
        }
        @media(max-width:640px){
            .hero{padding:52px 0 58px}
            section.block{padding:46px 0}
            .banner{padding:38px 24px}
            .card{padding:24px}
            .ident .orgname{display:none}
        }
        @media(prefers-reduced-motion:reduce){ *{transition:none!important;animation:none!important} }
    </style>
</head>
<body>

<?php if (empty($bare)): ?>
    <header class="site">
        <div class="wrap">
            <a class="ident" href="<?= View::e(! empty($org['slug']) ? View::orgUrl($org['slug']) : View::appBaseUrl()) ?>">
                <?php if ($mark = Brand::markUrl()): ?>
                    <img class="mark" src="<?= View::e($mark) ?>" alt="">
                <?php endif; ?>
                <span class="wordmark"><?= View::e(Brand::name()) ?></span>
                <?php if (! empty($org['logo_url'])): ?>
                    <span class="rule"></span>
                    <img class="orglogo" src="<?= View::e($org['logo_url']) ?>" alt="<?= View::e($org['name']) ?>">
                <?php elseif (! empty($org['name'])): ?>
                    <span class="rule"></span>
                    <span class="orgname"><?= View::e($org['name']) ?></span>
                <?php endif; ?>
            </a>

            <?php if (! empty($org['slug'])): ?>
                <a class="btn sm" href="<?= View::e(View::memberAppUrl($org['slug'], $ticket ?? null)) ?>">
                    <?= ! empty($ticket) ? 'Go to my dashboard' : 'Sign in' ?>
                </a>
            <?php endif; ?>
        </div>
    </header>
<?php endif; ?>

<main<?= ! empty($bare) ? ' class="fill"' : '' ?>><?= $content ?></main>

<?php if (empty($bare)): ?>
    <footer class="site">
        <div class="wrap">
            <span>&copy; <?= date('Y') ?> <?= View::e(Brand::name()) ?>. All rights reserved.</span>
            <span>Questions?
                <a href="mailto:<?= View::e(Brand::support()) ?>"><?= View::e(Brand::support()) ?></a>
            </span>
        </div>
    </footer>
<?php endif; ?>

</body>
</html>

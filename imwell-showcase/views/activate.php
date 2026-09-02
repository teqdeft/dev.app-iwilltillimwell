<?php
use Showcase\Brand;
use Showcase\View;

// Full-bleed split screen, like the application's own login - no site chrome.
$bare = true;
$hero = Brand::heroUrl();
?>

<div class="auth">

    <div class="auth-art"<?= $hero ? ' style="background-image:url(' . View::e($hero) . ')"' : '' ?>>
        <div class="quote">
            <strong>Care that comes to you.</strong>
            <span>
                Doctors, therapists and specialists &mdash; included by
                <?= View::e($org['name']) ?>, at no cost to you.
            </span>
        </div>
    </div>

    <div class="auth-form">
        <div class="authcard">

            <div class="logos">
                <?php if (! empty($org['logo_url'])): ?>
                    <img class="org" src="<?= View::e($org['logo_url']) ?>"
                         alt="<?= View::e($org['name']) ?> logo">
                    <span class="rule"></span>
                <?php endif; ?>
                <span class="lockup">
                    <?php if ($mark = Brand::markUrl()): ?>
                        <img class="mark" src="<?= View::e($mark) ?>" alt="">
                    <?php endif; ?>
                    <span class="wordmark"><?= View::e(Brand::name()) ?></span>
                </span>
            </div>

            <h1>Welcome<?= ! empty($member['first_name']) ? ', ' . View::e($member['first_name']) : '' ?></h1>
            <p class="sub">
                Choose a password to activate your <strong><?= View::e($org['name']) ?></strong> account.
            </p>

            <?php if (! empty($error)): ?>
                <div class="alert" role="alert"><?= View::e($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= View::e(View::activateUrl($org['slug'], $token)) ?>">
                <input type="hidden" name="_token" value="<?= View::e($csrf) ?>">

                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" value="<?= View::e($member['email'] ?? '') ?>"
                           readonly tabindex="-1">
                </div>

                <div class="field">
                    <label for="password">Create a password</label>
                    <div class="box">
                        <input id="password" name="password" type="password" class="has-toggle"
                               required minlength="8" autocomplete="new-password" autofocus>
                        <button type="button" class="toggle" id="toggle" aria-label="Show password">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor"
                                 stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2.2 12S5.8 5.5 12 5.5 21.8 12 21.8 12 18.2 18.5 12 18.5 2.2 12 2.2 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    <div class="meter"><i id="bar"></i></div>
                    <p class="meter-label" id="meterLabel">At least 8 characters.</p>
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           required minlength="8" autocomplete="new-password">
                    <p class="help" id="matchLabel"></p>
                </div>

                <button type="submit" class="btn block">Activate my account</button>
            </form>

            <p class="foot">
                This activation link can only be used once.<br>
                Need help? <a href="mailto:<?= View::e(Brand::support()) ?>"><?= View::e(Brand::support()) ?></a>
            </p>

        </div>
    </div>
</div>

<script>
(function () {
    var pw     = document.getElementById('password'),
        cf     = document.getElementById('password_confirmation'),
        toggle = document.getElementById('toggle'),
        bar    = document.getElementById('bar'),
        label  = document.getElementById('meterLabel'),
        match  = document.getElementById('matchLabel');

    if (!pw || !cf) { return; }

    toggle.addEventListener('click', function () {
        var show = pw.type === 'password';
        pw.type = show ? 'text' : 'password';
        toggle.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
    });

    // Guidance only. What actually decides is the server: at least 8
    // characters, and the two entries must match.
    var STEPS = [
        { w: '25%',  c: '#d0453f', t: 'Too short — use at least 8 characters.' },
        { w: '50%',  c: '#d98324', t: 'Weak — try adding numbers or symbols.' },
        { w: '75%',  c: '#b28a2e', t: 'Good.' },
        { w: '100%', c: '#1f7a4d', t: 'Strong.' }
    ];

    function score(v) {
        if (v.length < 8) { return 0; }
        var s = 1;
        if (/[a-z]/.test(v) && /[A-Z]/.test(v)) { s++; }
        if (/[0-9]/.test(v)) { s++; }
        if (/[^A-Za-z0-9]/.test(v)) { s++; }
        if (v.length >= 12) { s++; }
        return Math.min(s, 4);
    }

    function paint() {
        var v = pw.value;

        if (!v) {
            bar.style.width = '0';
            bar.parentNode.classList.remove('on');
            label.textContent = 'At least 8 characters.';
        } else {
            bar.parentNode.classList.add('on');
            var step = STEPS[Math.max(score(v) - 1, 0)];
            bar.style.width = step.w;
            bar.style.background = step.c;
            label.textContent = step.t;
        }

        if (!cf.value) {
            match.textContent = '';
        } else if (cf.value === pw.value) {
            match.textContent = 'Passwords match.';
            match.style.color = '#1f7a4d';
        } else {
            match.textContent = 'Passwords do not match yet.';
            match.style.color = '#a3212c';
        }
    }

    pw.addEventListener('input', paint);
    cf.addEventListener('input', paint);
})();
</script>

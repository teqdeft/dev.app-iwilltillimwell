<?php
use Showcase\Brand;
use Showcase\View;

$appUrl = View::memberAppUrl($org['slug']);
$count  = count($services);

// Every bullet across the enabled services, for the "everything included" list.
$allDetails = [];
foreach ($services as $s) {
    foreach ((array) ($s['details'] ?? []) as $d) {
        $allDetails[] = $d;
    }
}
?>

<div class="hero">
    <div class="wrap">
        <div class="hero-grid">
            <div>
                <span class="eyebrow">Member benefits</span>
                <h1><?= View::e($org['name']) ?></h1>

                <div class="lead">
                    <?php if (! empty($org['description'])): ?>
                        <?= strip_tags((string) $org['description'], '<p><br><strong><b><em><i><u><ul><ol><li><a><h3>') ?>
                    <?php else: ?>
                        <p>
                            <?= View::e($org['name']) ?> provides the healthcare services below to
                            its members &mdash; virtual, on demand, and at no cost to you.
                        </p>
                    <?php endif; ?>
                </div>

                <div class="cta-row">
                    <a class="btn on-dark" href="<?= View::e($appUrl) ?>">Sign in to the app</a>
                    <?php if ($count): ?>
                        <a class="btn outline-light" href="#services">See what is included</a>
                    <?php endif; ?>
                </div>
                <p class="hint">
                    New here? Use the activation link we emailed you to set your password.
                </p>
            </div>

            <div class="orgplate">
                <?php if (! empty($org['logo_url'])): ?>
                    <img src="<?= View::e($org['logo_url']) ?>" alt="<?= View::e($org['name']) ?> logo">
                <?php else: ?>
                    <div class="fallback"><?= View::e($org['name']) ?></div>
                <?php endif; ?>
                <span class="cap">Benefits provided by</span>
            </div>
        </div>
    </div>
</div>

<?php if ($count): ?>
    <section class="block" id="services">
        <div class="wrap">
            <div class="headline mid">
                <h2>Everything <?= View::e($org['name']) ?> has made available</h2>
                <p>
                    Each of these is switched on for you already. There is nothing to buy and
                    nothing to claim back.
                </p>
            </div>

            <div class="grid">
                <?php foreach ($services as $service): ?>
                    <div class="card">
                        <div class="ico"><?= Brand::icon($service['key']) ?></div>
                        <h3><?= View::e($service['label']) ?></h3>
                        <p><?= View::e($service['blurb']) ?></p>

                        <?php if (! empty($service['details'])): ?>
                            <ul>
                                <?php foreach ($service['details'] as $detail): ?>
                                    <li><?= View::e($detail) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="block tight">
        <div class="wrap">
            <div class="facts">
                <div class="fact">
                    <div class="n"><?= $count ?></div>
                    <div class="l">Service<?= $count === 1 ? '' : 's' ?> included</div>
                </div>
                <div class="fact">
                    <div class="n"><?= count($allDetails) ?></div>
                    <div class="l">Things you can do from day one</div>
                </div>
                <div class="fact">
                    <div class="n">$0</div>
                    <div class="l">Cost to you</div>
                </div>
                <div class="fact">
                    <div class="n">24/7</div>
                    <div class="l">Care available day and night</div>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="block">
        <div class="wrap">
            <div class="panel" style="text-align:center;max-width:600px;margin:0 auto">
                <h2 style="font-size:22px;margin-bottom:10px">Services are on their way</h2>
                <p style="color:var(--body);margin:0">
                    <?= View::e($org['name']) ?> has not published its services yet. Please check
                    back shortly, or contact your administrator.
                </p>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="block<?= $count ? ' tight' : '' ?>">
    <div class="wrap">
        <div class="headline mid">
            <h2>How it works</h2>
            <p>Three steps, once. After that you just sign in.</p>
        </div>

        <div class="steps">
            <div class="step">
                <h3>Activate your account</h3>
                <p>
                    Open the activation link emailed to you by <?= View::e($org['name']) ?> and
                    choose your own password. The link works once.
                </p>
            </div>
            <div class="step">
                <h3>See what you have</h3>
                <p>
                    Your dashboard lists every service your organization switched on, with what
                    each one covers.
                </p>
            </div>
            <div class="step">
                <h3>Start using it</h3>
                <p>
                    Book a consultation, message a specialist or open any of the services above
                    &mdash; from your phone or your computer.
                </p>
            </div>
        </div>
    </div>
</section>

<?php if ($allDetails): ?>
    <section class="block tight">
        <div class="wrap">
            <div class="panel">
                <div class="headline" style="margin-bottom:22px">
                    <h2 style="font-size:22px">Included in your membership</h2>
                    <p>Everything the services above cover, in one list.</p>
                </div>
                <div class="card" style="border:0;padding:0;background:transparent">
                    <ul style="columns:2;column-gap:44px;margin:0">
                        <?php foreach ($allDetails as $detail): ?>
                            <li style="break-inside:avoid"><?= View::e($detail) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="block tight">
    <div class="wrap">
        <div class="banner">
            <h2>Your benefits are waiting</h2>
            <p>
                <?= View::e($org['name']) ?> has already paid for your membership. Sign in to book
                a consultation, message a specialist and use everything above.
            </p>
            <a class="btn on-dark" href="<?= View::e($appUrl) ?>">Sign in to the app</a>

            <p class="sub">
                <?php if (! empty($org['contact_email'])): ?>
                    Questions about your benefits? Contact
                    <a href="mailto:<?= View::e($org['contact_email']) ?>"
                       style="color:#fff;text-decoration:underline"><?= View::e($org['contact_email']) ?></a>.
                <?php else: ?>
                    Need help? Email
                    <a href="mailto:<?= View::e(Brand::support()) ?>"
                       style="color:#fff;text-decoration:underline"><?= View::e(Brand::support()) ?></a>.
                <?php endif; ?>
            </p>
        </div>
    </div>
</section>

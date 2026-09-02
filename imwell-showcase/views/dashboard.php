<?php
use Showcase\View;

// With a ticket this walks straight into the application already signed in;
// without one it is the organization's branded sign-in page.
$appUrl = View::memberAppUrl($org['slug'], $ticket ?? null);
?>

<div class="hero">
    <div class="wrap">

        <?php if (! empty($welcome)): ?>
            <div class="notice">
                <span aria-hidden="true">&#10003;</span>
                <span>
                    Your account is active<?= ! empty($name) ? ', ' . View::e($name) : '' ?>.
                    Everything below is included by <?= View::e($org['name']) ?>.
                </span>
            </div>
        <?php endif; ?>

        <div class="hero-inner">
            <?php if (! empty($org['logo_url'])): ?>
                <div class="hero-logo">
                    <img src="<?= View::e($org['logo_url']) ?>" alt="<?= View::e($org['name']) ?> logo">
                </div>
            <?php endif; ?>

            <div class="hero-text">
                <span class="eyebrow">Your membership</span>
                <h1><?= View::e($org['name']) ?></h1>
                <p class="lead">
                    <?= count($services) ?>
                    service<?= count($services) === 1 ? '' : 's' ?>
                    <?= count($services) === 1 ? 'is' : 'are' ?>
                    included with your membership, at no cost to you.
                </p>

                <div class="cta-row">
                    <a class="btn lg" href="<?= View::e($appUrl) ?>">Continue to the app</a>
                </div>
                <p class="hint">
                    <?php if (! empty($ticket)): ?>
                        Takes you straight to your dashboard - no need to sign in again.
                    <?php else: ?>
                        Sign in with the email and password you chose.
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</div>

<section class="block">
    <div class="wrap">
        <h2>What is included</h2>
        <p class="sub">
            <?php if ($services): ?>
                <?= View::e($org['name']) ?> has switched these on for its members. Open any of
                them from your dashboard in the app.
            <?php else: ?>
                <?= View::e($org['name']) ?> has not switched on any services yet. Please check
                back, or contact your administrator.
            <?php endif; ?>
        </p>

        <?php if ($services): ?>
            <div class="grid">
                <?php foreach ($services as $service): ?>
                    <div class="card">
                        <h3><?= View::e($service['label']) ?></h3>
                        <p><?= View::e($service['blurb']) ?></p>

                        <?php if (! empty($service['details'])): ?>
                            <ul>
                                <?php foreach ($service['details'] as $detail): ?>
                                    <li><?= View::e($detail) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if ($link = View::servicePath($service['path'] ?? null)): ?>
                            <a class="open" href="<?= View::e($link) ?>">
                                Open <?= View::e($service['label']) ?> &rarr;
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="block" style="padding-top:0">
    <div class="wrap">
        <div class="panel" style="text-align:center">
            <h2>Ready when you are</h2>
            <p style="color:var(--muted);max-width:540px;margin:0 auto 20px">
                Your <?= View::e($org['name']) ?> membership is set up and paid for. Open the app
                to book a consultation, message a specialist and use everything above.
            </p>
            <a class="btn lg" href="<?= View::e($appUrl) ?>">Continue to the app</a>

            <?php if (! empty($org['contact_email'])): ?>
                <p style="font-size:13px;color:var(--muted);margin:20px 0 0">
                    Questions about your benefits? Contact
                    <a href="mailto:<?= View::e($org['contact_email']) ?>"><?= View::e($org['contact_email']) ?></a>.
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>

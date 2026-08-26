<?php use Showcase\View; ?>

<div class="hero">
    <div class="wrap">
        <?php if ($success): ?>
            <div class="alert alert-ok" style="margin-bottom:22px"><?= View::e($success) ?></div>
        <?php endif; ?>

        <div class="hero-inner">
            <?php if ($logo = View::logoUrl($org['logo'])): ?>
                <div class="hero-logo"><img src="<?= View::e($logo) ?>" alt="<?= View::e($org['name']) ?> logo"></div>
            <?php endif; ?>

            <div class="hero-text">
                <span class="eyebrow">Member benefits</span>
                <h1><?= View::e($org['name']) ?></h1>

                <?php if (! empty($org['description'])): ?>
                    <div class="lead"><?= strip_tags((string) $org['description'], '<p><br><strong><b><em><i><u><ul><ol><li><a><h3>') ?></div>
                <?php else: ?>
                    <p class="lead">
                        <?= View::e($org['name']) ?> provides the services below to its members
                        at no cost to you.
                    </p>
                <?php endif; ?>

                <div class="cta-row">
                    <?php if ($member): ?>
                        <a class="btn" href="<?= View::e($appUrl) ?>">Continue to the app</a>
                    <?php else: ?>
                        <a class="btn" href="/<?= View::e($org['slug']) ?>/login">Sign in</a>
                        <a class="btn ghost" href="<?= View::e($appUrl) ?>">Go to the app</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="block">
    <div class="wrap">
        <h2>Services offered</h2>
        <p class="sub">
            <?php if ($services): ?>
                These are the services <?= View::e($org['name']) ?> has made available to members.
            <?php else: ?>
                Services for this organization have not been published yet.
            <?php endif; ?>
        </p>

        <?php if ($services): ?>
            <div class="grid">
                <?php foreach ($services as $service): ?>
                    <div class="card">
                        <h3><?= View::e($service['label']) ?></h3>
                        <p><?= View::e($service['blurb']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="block" style="padding-top:0">
    <div class="wrap">
        <div class="panel">
            <h2><?= $member ? 'You are signed in' : 'Already a member?' ?></h2>
            <?php if ($member): ?>
                <p style="color:var(--muted)">
                    Signed in as <?= View::e($member['email']) ?>. Open the app to use your services.
                </p>
                <a class="btn" href="<?= View::e($appUrl) ?>">Continue to the app</a>
            <?php else: ?>
                <p style="color:var(--muted)">
                    If <?= View::e($org['name']) ?> has registered you, use the activation link we
                    emailed you to set a password &mdash; then sign in here or go straight to the app.
                </p>
                <a class="btn" href="/<?= View::e($org['slug']) ?>/login">Sign in</a>
            <?php endif; ?>
        </div>
    </div>
</section>

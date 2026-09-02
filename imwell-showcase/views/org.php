<?php use Showcase\View; ?>
<?php $appUrl = View::memberAppUrl($org['slug']); ?>

<div class="hero">
    <div class="wrap">
        <div class="hero-inner">
            <?php if (! empty($org['logo_url'])): ?>
                <div class="hero-logo">
                    <img src="<?= View::e($org['logo_url']) ?>" alt="<?= View::e($org['name']) ?> logo">
                </div>
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
                    <a class="btn" href="<?= View::e($appUrl) ?>">Sign in to the app</a>
                </div>
                <p class="hint">
                    New here? Use the activation link we emailed you to set your password.
                </p>
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
        <?php endif; ?>
    </div>
</section>

<section class="block" style="padding-top:0">
    <div class="wrap">
        <div class="panel" style="text-align:center">
            <h2>Ready when you are</h2>
            <p style="color:var(--muted);max-width:520px;margin:0 auto 20px">
                Your <?= View::e($org['name']) ?> membership is already set up. Open the app to
                book a consultation, message a specialist and use everything above.
            </p>
            <a class="btn" href="<?= View::e($appUrl) ?>">Sign in to the app</a>
        </div>
    </div>
</section>

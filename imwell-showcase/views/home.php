<?php use Showcase\View; ?>

<div class="hero">
    <div class="wrap">
        <div class="hero-text">
            <span class="eyebrow">iMWELL</span>
            <h1>Healthcare, counseling and wellbeing &mdash; provided by your organization.</h1>
            <p class="lead">
                Find your organization below to see the services it offers and to sign in
                to your member account.
            </p>
        </div>
    </div>
</div>

<section class="block">
    <div class="wrap">
        <h2>Organizations</h2>
        <p class="sub">Choose your organization to continue.</p>

        <?php if (! $orgs): ?>
            <div class="panel">
                <p style="margin:0;color:var(--muted)">
                    No organizations are published yet. Once an administrator creates one,
                    it will appear here automatically.
                </p>
            </div>
        <?php else: ?>
            <div class="grid">
                <?php foreach ($orgs as $o): ?>
                    <a class="card" href="/<?= View::e($o['slug']) ?>">
                        <?php if ($logo = View::logoUrl($o['logo'])): ?>
                            <span class="card-logo"><img src="<?= View::e($logo) ?>" alt="<?= View::e($o['name']) ?>"></span>
                        <?php endif; ?>
                        <h3><?= View::e($o['name']) ?></h3>
                        <p><?= View::e(mb_strimwidth(trim(strip_tags((string) $o['description'])), 0, 110, '...')) ?: 'View services and sign in.' ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
use Showcase\Brand;
use Showcase\View;

// With a ticket this walks straight into the application already signed in;
// without one it is the organization's branded sign-in page.
$appUrl = View::memberAppUrl($org['slug'], $ticket ?? null);
$count  = count($services);
?>

<div class="hero">
    <div class="wrap">

        <?php if (! empty($welcome)): ?>
            <div class="notice on-hero">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"/><path d="M8.4 12.3l2.5 2.5 4.7-4.9"/>
                </svg>
                <span>
                    Your account is active<?= ! empty($name) ? ', ' . View::e($name) : '' ?>.
                    Everything below is included by <?= View::e($org['name']) ?>.
                </span>
            </div>
        <?php endif; ?>

        <div class="hero-grid">
            <div>
                <span class="eyebrow">Your membership</span>
                <h1><?= View::e($org['name']) ?></h1>
                <div class="lead">
                    <?php if ($count): ?>
                        <p>
                            <?= $count ?> service<?= $count === 1 ? '' : 's' ?>
                            <?= $count === 1 ? 'is' : 'are' ?> included with your membership,
                            for you and at no cost to you.
                        </p>
                    <?php else: ?>
                        <p>Your account is ready. Services will appear here once your
                           administrator switches them on.</p>
                    <?php endif; ?>
                </div>

                <div class="cta-row">
                    <a class="btn on-dark" href="<?= View::e($appUrl) ?>">
                        Continue to the app
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h13M13 6l6 6-6 6"/>
                        </svg>
                    </a>
                </div>
                <p class="hint">
                    <?php if (! empty($ticket)): ?>
                        Takes you straight to your dashboard &mdash; no need to sign in again.
                    <?php else: ?>
                        Sign in with your email and the password you chose.
                    <?php endif; ?>
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
    <section class="block">
        <div class="wrap">
            <div class="headline">
                <h2>What is included</h2>
                <p>
                    <?= View::e($org['name']) ?> has switched these on for its members. Open any
                    of them from your dashboard in the app.
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

                        <?php if ($link = View::servicePath($service['path'] ?? null)): ?>
                            <a class="open" href="<?= View::e($link) ?>">
                                Open <?= View::e($service['label']) ?>
                                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h13M13 6l6 6-6 6"/>
                                </svg>
                            </a>
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
                    <div class="n">$0</div>
                    <div class="l">Cost to you &mdash; <?= View::e($org['name']) ?> covers it</div>
                </div>
                <div class="fact">
                    <div class="n">24/7</div>
                    <div class="l">Care available day and night</div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="block<?= $count ? ' tight' : '' ?>">
    <div class="wrap">
        <div class="banner">
            <h2>Ready when you are</h2>
            <p>
                Your <?= View::e($org['name']) ?> membership is set up and paid for. Open the app
                to book a consultation, message a specialist and use everything above.
            </p>
            <a class="btn on-dark" href="<?= View::e($appUrl) ?>">Continue to the app</a>

            <?php if (! empty($org['contact_email'])): ?>
                <p class="sub">
                    Questions about your benefits? Contact
                    <a href="mailto:<?= View::e($org['contact_email']) ?>"
                       style="color:#fff;text-decoration:underline"><?= View::e($org['contact_email']) ?></a>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>

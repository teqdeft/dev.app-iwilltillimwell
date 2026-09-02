<?php
use Showcase\Brand;
use Showcase\View;

$bare = true;
$hero = Brand::heroUrl();
?>

<div class="auth">

    <div class="auth-art"<?= $hero ? ' style="background-image:url(' . View::e($hero) . ')"' : '' ?>>
        <div class="quote">
            <strong>Care that comes to you.</strong>
            <span>Your benefits are still here &mdash; this particular link just expired.</span>
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

            <h1>This link is no longer valid</h1>
            <p class="sub"><?= View::e($message) ?></p>

            <?php if (! empty($org['slug'])): ?>
                <a class="btn block" href="<?= View::e(View::memberAppUrl($org['slug'])) ?>">
                    Sign in instead
                </a>
                <p class="foot">
                    Already activated? Sign in with the password you chose.<br>
                    Otherwise ask <?= View::e($org['name']) ?><?php if (! empty($org['contact_email'])): ?>
                        (<a href="mailto:<?= View::e($org['contact_email']) ?>"><?= View::e($org['contact_email']) ?></a>)
                    <?php endif; ?> for a new activation email.
                </p>
            <?php else: ?>
                <a class="btn block" href="<?= View::e(View::appBaseUrl()) ?>">
                    Go to <?= View::e(Brand::name()) ?>
                </a>
            <?php endif; ?>

        </div>
    </div>
</div>

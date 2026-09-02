<?php
use Showcase\View;

$hideNav = true;
?>

<div class="formwrap">
    <div class="formcard">

        <?php if (! empty($org['logo_url'])): ?>
            <div class="logo">
                <img src="<?= View::e($org['logo_url']) ?>" alt="<?= View::e($org['name']) ?> logo">
            </div>
        <?php endif; ?>

        <h1>This link is no longer valid</h1>
        <p class="sub"><?= View::e($message) ?></p>

        <?php if (! empty($org['slug'])): ?>
            <a class="btn lg block" href="<?= View::e(View::memberAppUrl($org['slug'])) ?>">
                Sign in instead
            </a>
            <p class="foot">
                Already activated? Sign in with the password you chose.<br>
                Otherwise ask <?= View::e($org['name']) ?>
                <?php if (! empty($org['contact_email'])): ?>
                    (<a href="mailto:<?= View::e($org['contact_email']) ?>"><?= View::e($org['contact_email']) ?></a>)
                <?php endif; ?>
                for a new activation email.
            </p>
        <?php else: ?>
            <a class="btn lg block" href="<?= View::e(View::appBaseUrl()) ?>">
                Go to iWILL &lsquo;til i&rsquo;mWELL
            </a>
        <?php endif; ?>

    </div>
</div>

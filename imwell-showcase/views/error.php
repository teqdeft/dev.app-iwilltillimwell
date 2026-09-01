<?php use Showcase\View; ?>

<section class="block">
    <div class="wrap">
        <div class="panel" style="max-width:560px;margin:0 auto;text-align:center">
            <h2><?= View::e($title ?? 'Something went wrong') ?></h2>
            <p style="color:var(--muted);margin:0 0 20px">
                <?= View::e($message ?? 'We could not load this page.') ?>
            </p>
            <?php if (! empty($detail)): ?>
                <p style="color:#a3212c;font-size:13px;margin:0 0 20px"><?= View::e($detail) ?></p>
            <?php endif; ?>
            <a class="btn" href="<?= View::e(View::appBaseUrl()) ?>">Go to iWILL &lsquo;til i&rsquo;mWELL</a>
        </div>
    </div>
</section>

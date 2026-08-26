<?php use Showcase\View; ?>

<div class="authwrap">
    <div class="authcard">
        <div class="head">
            <h1><?= View::e($title ?? 'Something went wrong') ?></h1>
        </div>
        <div class="body">
            <p style="margin:0 0 18px;color:var(--muted);font-size:14px">
                <?= View::e($message ?? 'We could not load this page.') ?>
            </p>
            <?php if (! empty($detail)): ?>
                <div class="alert alert-error"><?= View::e($detail) ?></div>
            <?php endif; ?>
            <a class="btn block" href="/">Back to organizations</a>
        </div>
    </div>
</div>

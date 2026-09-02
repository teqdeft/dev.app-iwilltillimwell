<?php
use Showcase\Brand;
use Showcase\View;
?>

<section class="block">
    <div class="wrap">
        <div class="panel" style="max-width:560px;margin:40px auto;text-align:center">
            <div style="width:56px;height:56px;border-radius:16px;margin:0 auto 20px;
                display:flex;align-items:center;justify-content:center;
                color:var(--brand);background:rgba(109,87,143,.10)">
                <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor"
                     stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"/><path d="M12 7.6v5.1"/><path d="M12 16.2h.01"/>
                </svg>
            </div>

            <h2 style="font-size:23px;margin-bottom:12px">
                <?= View::e($title ?? 'Something went wrong') ?>
            </h2>
            <p style="color:var(--body);margin:0 0 24px">
                <?= View::e($message ?? 'We could not load this page.') ?>
            </p>

            <?php if (! empty($detail)): ?>
                <p class="alert" style="text-align:left"><?= View::e($detail) ?></p>
            <?php endif; ?>

            <?php if ($appUrl = View::appBaseUrl()): ?>
                <a class="btn" href="<?= View::e($appUrl) ?>">
                    Go to <?= View::e(Brand::name()) ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

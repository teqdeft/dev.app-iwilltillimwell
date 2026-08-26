<?php use Showcase\View; ?>

<div class="authwrap">
    <div class="authcard">
        <div class="head">
            <?php if ($logo = View::logoUrl($org['logo'])): ?>
                <img src="<?= View::e($logo) ?>" alt="<?= View::e($org['name']) ?> logo">
            <?php endif; ?>
            <h1>This link is no longer valid</h1>
        </div>

        <div class="body">
            <p style="margin:0 0 18px;color:var(--muted);font-size:14px">
                Your activation link has either expired or has already been used.
            </p>

            <a class="btn block" href="/<?= View::e($org['slug']) ?>/login">Go to sign in</a>

            <p class="muted">
                If you have not activated your account yet, please ask your
                <?= View::e($org['name']) ?> administrator to resend the invitation.
            </p>
        </div>
    </div>
</div>

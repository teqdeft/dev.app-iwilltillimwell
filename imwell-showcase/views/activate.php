<?php use Showcase\View; ?>

<div class="authwrap">
    <div class="authcard">
        <div class="head">
            <?php if ($logo = View::logoUrl($org['logo'])): ?>
                <img src="<?= View::e($logo) ?>" alt="<?= View::e($org['name']) ?> logo">
            <?php endif; ?>
            <h1>Welcome<?= $activation['fname'] ? ', ' . View::e($activation['fname']) : '' ?></h1>
        </div>

        <div class="body">
            <p style="margin:0 0 18px;color:var(--muted);font-size:14px">
                Choose a password to activate your <?= View::e($org['name']) ?> account.
            </p>

            <?php foreach ($errors as $error): ?>
                <div class="alert alert-error"><?= View::e($error) ?></div>
            <?php endforeach; ?>

            <form method="POST" action="/<?= View::e($org['slug']) ?>/activate/<?= View::e($token) ?>">
                <input type="hidden" name="_token" value="<?= View::e($csrf) ?>">

                <div class="field">
                    <label>Email address</label>
                    <input type="email" value="<?= View::e($activation['email']) ?>" disabled>
                </div>

                <div class="field">
                    <label for="password">Create password</label>
                    <input type="password" name="password" id="password" required autofocus autocomplete="new-password">
                    <div class="hint">At least 8 characters.</div>
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           required autocomplete="new-password">
                </div>

                <button type="submit" class="btn block">Activate my account</button>
            </form>

            <p class="muted">This activation link can only be used once.</p>
        </div>
    </div>
</div>

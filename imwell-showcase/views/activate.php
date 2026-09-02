<?php
use Showcase\View;

// No "Go to the app" button while activating - there is nothing to go to yet.
$hideNav = true;
?>

<div class="formwrap">
    <div class="formcard">

        <?php if (! empty($org['logo_url'])): ?>
            <div class="logo">
                <img src="<?= View::e($org['logo_url']) ?>" alt="<?= View::e($org['name']) ?> logo">
            </div>
        <?php endif; ?>

        <h1>Welcome<?= ! empty($member['first_name']) ? ', ' . View::e($member['first_name']) : '' ?></h1>
        <p class="sub">
            Choose a password to activate your <?= View::e($org['name']) ?> account.
        </p>

        <?php if (! empty($error)): ?>
            <div class="alert"><?= View::e($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= View::e(View::activateUrl($org['slug'], $token)) ?>" autocomplete="on">
            <input type="hidden" name="_token" value="<?= View::e($csrf) ?>">

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" value="<?= View::e($member['email'] ?? '') ?>" readonly>
            </div>

            <div class="field">
                <label for="password">Create a password</label>
                <input id="password" name="password" type="password" required minlength="8"
                       autocomplete="new-password" autofocus>
                <p class="help">At least 8 characters.</p>
            </div>

            <div class="field">
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                       required minlength="8" autocomplete="new-password">
            </div>

            <button type="submit" class="btn lg block">Activate my account</button>
        </form>

        <p class="foot">This activation link can only be used once.</p>
    </div>
</div>

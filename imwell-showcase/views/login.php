<?php use Showcase\View; ?>

<div class="authwrap">
    <div class="authcard">
        <div class="head">
            <?php if ($logo = View::logoUrl($org['logo'])): ?>
                <img src="<?= View::e($logo) ?>" alt="<?= View::e($org['name']) ?> logo">
            <?php endif; ?>
            <h1><?= View::e($org['name']) ?></h1>
        </div>

        <div class="body">
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-error"><?= View::e($error) ?></div>
            <?php endforeach; ?>

            <form method="POST" action="/<?= View::e($org['slug']) ?>/login">
                <input type="hidden" name="_token" value="<?= View::e($csrf) ?>">

                <div class="field">
                    <label for="email">Email address</label>
                    <input type="email" name="email" id="email" value="<?= View::e($email) ?>"
                           required autofocus autocomplete="username">
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required autocomplete="current-password">
                </div>

                <button type="submit" class="btn block">Sign in</button>
            </form>

            <p class="muted">
                Haven't set a password yet? Use the activation link emailed to you by
                <?= View::e($org['name']) ?>.
            </p>
        </div>
    </div>
</div>

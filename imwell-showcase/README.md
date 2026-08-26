# imwell.app — showcase site

A small standalone PHP site for **imwell.app**. It has no framework and no schema of
its own: it reads the main application's database and shows, per organization, the
name, logo, description and the services the admin enabled.

It handles account **activation** and a local **sign in**, then points members at the
main app.

## What it does

| Route | Purpose |
|---|---|
| `/` | Directory of active organizations |
| `/{slug}` | Landing page: logo, name, about, services offered |
| `/{slug}/login` | Branded sign in |
| `/{slug}/activate/{token}` | Member sets their own password |
| `/{slug}/logout` | Sign out |

`{slug}` is the same slug the main app generates from the organization name, so
`Satluj School` → `imwell.app/satluj-school`.

## Deploying

Point the **imwell.app** document root at `imwell-showcase/public`. Nothing else is
required — no Composer, no build step. PHP 7.4+ with PDO MySQL.

Database credentials are read from `../.env` (the main application's) automatically.
If this folder is deployed somewhere that file is not readable, copy `.env.example`
to `.env` and fill in the DB values.

## How it relates to the main app

- **Database:** shared, read-only except for activation.
- **Schema:** owned entirely by the main app (`imwell_orgs`, `imwell_org_features`,
  `imwell_org_activations`, `users`). Create an organization there and it appears
  here immediately.
- **Passwords:** bcrypt, so hashes written here are readable by Laravel and vice versa.
- **Activation** sets the password, marks the token used and sets `status = 1`. It
  deliberately does **not** grant app access (`payment_status`, `doctor_step`, the
  sponsored subscription). The main app's `EnforceOrgAccess` middleware does that on
  the member's first request there, so that logic stays in one place.
- **Service catalogue:** the labels and blurbs in `src/Repository.php::FEATURES` mirror
  `modules/ImwellApp/Config/features.php`. If you add a feature there, add it here too
  or it simply won't be described on the landing page.

## Sessions — a real limitation

Signing in here creates a session for **imwell.app only**. Browsers cannot share
cookies across different root domains, so a member who signs in here is **not** signed
in on the main app; "Continue to the app" sends them there to sign in once.

Making that seamless needs a one-time token handoff: the showcase site would redirect
to something like `app.iwilltilimwell.com/auto-login?token=…`, and the main app would
verify the token and start the session. The main app already ships `/api/auto-login`
and Sanctum, so the pieces exist — it just hasn't been wired up.

## Pointing activation emails here

The main app currently emails activation links to its own domain
(`OrgImportController::sendActivation`). To send members here instead, change that URL
to `https://imwell.app/{slug}/activate/{token}`. The token is validated against the
same table either way, so both work — pick one so members aren't split across two
domains.

## Files

```
public/index.php     front controller and routing
public/.htaccess     pretty URLs
src/Config.php       reads .env (own, else the main app's)
src/Database.php     PDO connection
src/Repository.php   all queries + the service catalogue
src/Session.php      session, CSRF
src/View.php         tiny renderer, escaping, logo URLs
views/               layout + pages
```

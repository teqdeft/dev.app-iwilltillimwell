# imwell.app — organization landing page

One dynamic page, per organization. A member lands here after activating their
account in the main application, sees who provides their benefits and what is
included, and presses a button to go into the app.

Deliberately small: no framework, no schema of its own, **no sign in, no
activation, and no writes**. It reads the main application's database and
renders a page.

| Route | Purpose |
|---|---|
| `/` | 302 to the main application |
| `/{slug}` | The organization's landing page |
| anything else | 404 |

`{slug}` is the same slug the main app generates from the organization name, so
`Satluj School` → `imwell.app/satluj-school`.

## The member journey

1. Admin imports the sheet. Each member is emailed a one-time activation link
   pointing at the **main app**: `app.iwilltilimwell.com/org/{slug}/activate/{token}`.
2. The member sets their own password there. The main app marks the token used,
   sets `status = 1`, grants org access (`OrgAccess::sync`) and **signs them in**.
3. It then redirects them here, to `imwell.app/{slug}`.
4. **Continue to the app** sends them to `{APP_URL}/org/{slug}`. They already
   have a session on that domain, so `OrgAuthController::showLogin` drops them
   straight at the dashboard — no second password prompt.

Step 4 targets the organization's own sign-in URL rather than the bare app root,
so a member who arrives without a session still gets the org-branded login
instead of the generic one.

## Why there is no sign in here

A session created on imwell.app does not exist on app.iwilltilimwell.com —
browsers do not share cookies across root domains. Signing in here would have
meant typing the password twice. Activation and sign in therefore live in the
main app only, and this site is a read-only shop window.

That is also why `Database` exposes `select()` and nothing else: there is no code
path from this site that can modify the shared database.

## Deploying

> **Check what is on imwell.app first.** That domain currently serves a complete
> Laravel 8 application (`bitbucket.org:developers_teq/imwell`, whose `.env` reads
> `APP_URL=https://imwell.app`). It is deployed cPanel-style with `index.php` at
> the repo root, so **pointing the document root here would replace that whole
> application**, including its legacy `Company` / `/services/{slug}` organization
> flow. Do not repoint imwell.app until that site is confirmed retired.

Point the chosen document root at `imwell-showcase/public`. Nothing else is
required — no Composer, no build step. PHP 7.4+ with PDO MySQL.

Safe options while the legacy site is still live:

- a **subdomain** — `members.imwell.app`, `go.imwell.app`
- a **sub-directory** — the front controller strips its own base path, so
  `imwell.app/members` works unchanged
- a **different domain** entirely

Database credentials are read from `../.env` (the main application's)
automatically. If this folder is deployed where that file is not readable, copy
`.env.example` to `.env` and fill in the DB values plus `APP_URL`.

## Turning it on

The main app decides, from one environment variable, whether members are sent
here after activating. Add to the **main application's** `.env`:

```
IMWELL_SHOWCASE_URL=https://members.imwell.app
```

With it set, `ImwellOrg::landingUrl()` returns this site and
`OrgAuthController::activate()` finishes here. With it unset (the default),
activation ends on the dashboard and this site is simply never linked to.

Activation links always point at the main app either way — `activationUrl()`
ignores this variable on purpose, because there is no activation screen here.

Run `php artisan config:clear` after changing it; `mergeConfigFrom()` is skipped
while the config cache is warm, so a cached config ignores the new value.

## Keeping the service list honest

The labels and blurbs in `src/Repository.php::FEATURES` mirror
`modules/ImwellApp/Config/features.php`. Add a feature there and add it here too,
or it will not be described on the landing page.

## Files

```
public/index.php     front controller and routing
public/.htaccess     pretty URLs
src/Config.php       reads .env (own, else the main app's)
src/Database.php     PDO connection, select only
src/Repository.php   the queries + the service catalogue
src/View.php         tiny renderer, escaping, URLs
views/layout.php     page chrome
views/org.php        the landing page
views/error.php      404 and 500
```

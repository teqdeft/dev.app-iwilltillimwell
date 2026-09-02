# imwell.app — member activation and organization dashboard

The second site. A member imported by an admin activates their account here,
lands on a dashboard listing exactly the services their organization switched
on, and presses one button to walk into the main application already signed in.

No framework, no schema of its own, and **no database credentials**. Everything
it shows and everything it changes goes through the main application's API.

| Route | Purpose |
|---|---|
| `GET /` | 302 to the main application |
| `GET /activate/{slug}/{token}` | choose a password |
| `POST /activate/{slug}/{token}` | activate the account |
| `GET /{slug}` | the organization's public landing page |
| `GET /{slug}/dashboard` | the member's services after activating |
| anything else | 404 |

`{slug}` is the same slug the main app generates from the organization name, so
`Satluj School` → `imwell.app/satluj-school`.

## The member journey

1. Admin imports the sheet in **admin → ImWell App → Import**. Each member is
   emailed a one-time activation link pointing **here**:
   `imwell.app/activate/{slug}/{token}`.
2. The member chooses a password on this site. It is POSTed to the main
   application, which sets the password, marks the token used, sets
   `status = 1`, grants organization access (`OrgAccess::sync`), registers them
   on Lyric if that is enabled, and returns a **one-time hand-off ticket**.
3. They land on `imwell.app/{slug}/dashboard`, listing the services their
   organization enabled, each with what it includes.
4. **Continue to the app** spends the ticket at
   `{APP_URL}/org/{slug}/continue/{ticket}`. The main application validates it,
   signs them in on its own domain and drops them at the dashboard — no second
   password prompt.

Without a ticket — an ordinary visit to `/{slug}` — that button targets the
organization's own sign-in URL rather than the bare app root, so a member still
gets the org-branded login instead of the generic one.

## Why the ticket exists

A session created on imwell.app does not exist on dev.iwilltilimwell.com —
browsers do not share cookies across root domains. Without the ticket, a member
who had just chosen a password would be asked for it again the instant they
pressed the button.

The ticket closes that gap and nothing more: single use, expires in 30 minutes
(`IMWELL_HANDOFF_MINUTES`), burned the first time it is looked at, and useless
to anyone who did not just activate. It is the only thing this site can present
that identifies a member.

## Why activation goes through the API

Activating is not one UPDATE. It sets the password, spends the token, flips the
member into the "my organization pays for me" state, writes the sponsored
`braintree_subscription` row that decides which dashboard tiles unlock, and
registers them on Lyric. Those rules live in the main application and would rot
the moment they were copied into raw SQL on a second domain.

So this site holds no database credentials at all — only `APP_URL` and a shared
secret. `src/Api.php` is its single route to the data.

## Deploying

> **imwell.app previously served a different application** — a complete Laravel 8
> app (`bitbucket.org:developers_teq/imwell`) with its own `Company` /
> `/services/{slug}` organization flow and its own admin. This site replaced it, so
> those legacy URLs no longer resolve. If any organization was still using
> `/services/{slug}`, or if anyone still has the old React Native app installed
> (its WebView loaded `imwell.app/app-redirect/{token}`), those journeys are gone.
> Keep that repo — it is the only copy of that product.

PHP 7.4+ with cURL. No Composer, no build step. Three layouts work:

**A — document root at `imwell-showcase/public`** (preferred). Only `public/` is
reachable over HTTP; `src/` and `views/` sit above it and cannot be fetched.

**B — this folder itself as the document root** (cPanel `public_html`). cPanel will
not let you repoint a primary domain, so this is often the only option. `index.php`
at the root forwards to `public/index.php`, and the `.htaccess` beside it blocks
`src/`, `views/`, `.env` and `*.md` from being served. **Both files must be present**
— without the `.htaccess`, your source and your shared secret are downloadable.

**C — a sub-directory**, e.g. `imwell.app/members`. The front controller strips its
own base path, so no configuration is needed.

> The root `.gitignore` ignores `.env.*` and `.htaccess` everywhere, which would
> have kept `.htaccess`, `public/.htaccess` and `.env.example` out of every
> clone — including the two files layout B depends on for its safety. This
> folder's own `.gitignore` re-includes all three. If you add another, check it
> is actually tracked before relying on it being deployed.

## Configuration

### This site

Settings are read from `../.env` (the main application's) automatically. Once
this site lives on its own domain that file is not readable, so copy
`.env.example` to `.env` and fill in:

```
APP_URL=https://dev.iwilltilimwell.com
IMWELL_SHOWCASE_SECRET=<the shared secret>
APP_DEBUG=false
```

### The main application

```
IMWELL_SHOWCASE_URL=https://imwell.app
IMWELL_SHOWCASE_SECRET=<the same shared secret>
IMWELL_HANDOFF_MINUTES=30
```

Generate the secret with:

```bash
php -r "echo bin2hex(random_bytes(32));"
```

`IMWELL_SHOWCASE_URL` is the switch. With it set, activation emails point here
and `ImwellOrg::activationUrl()` returns this site. With it unset, activation
stays on the main application exactly as before and this site is never linked
to. The API **fails closed**: while `IMWELL_SHOWCASE_SECRET` is empty on the
main application, `/api/imwell/*` answers 503 and nothing here can activate
anything.

Run `php artisan config:clear` after changing either — `mergeConfigFrom()` is
skipped while the config cache is warm, so a cached config ignores new values.

Then run the migration for the hand-off table:

```bash
php artisan migrate
```

### Links already in inboxes

Emails sent before the switch point at `{APP_URL}/org/{slug}/activate/{token}`.
That screen is still live and still works; it now finishes on this site's
dashboard, carrying its own ticket, so both generations of link end in the same
place.

## Keeping the service list honest

There is nothing to keep in step. Labels, blurbs and the bullet lists all come
from `modules/ImwellApp/Config/features.php` through the API — add a feature
there and it appears here, described, with no change to this site.

## Files

```
index.php               shim for layout B; forwards to public/index.php
.htaccess               layout B only: blocks src/, views/, .env, *.md
public/index.php        front controller and routing
public/.htaccess        pretty URLs and security headers
src/Config.php          reads .env (own, else the main app's)
src/Api.php             the only route to the main application
src/Session.php         CSRF token + the hand-off ticket, nothing else
src/View.php            tiny renderer, escaping, URLs
views/layout.php        page chrome
views/activate.php      choose a password
views/activate-invalid.php  spent or expired link
views/dashboard.php     the member's services after activating
views/org.php           public landing page
views/error.php         404, 500 and 503
```

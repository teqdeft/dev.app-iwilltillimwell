<?php

/**
 * imwell.app - member activation and organization dashboard.
 *
 * The whole member journey after an admin imports the sheet:
 *
 *   1. The activation email points here.
 *   2. The member chooses a password on this site; it is sent to the main
 *      application's API, which activates the account and returns a one-time
 *      hand-off ticket.
 *   3. They land on their organization's dashboard here, listing exactly the
 *      services their admin switched on.
 *   4. "Continue to the app" spends the ticket on the main application, which
 *      signs them in there - no second password prompt.
 *
 * There are no database credentials on this site and no user accounts of its
 * own: everything it shows and everything it changes goes through the API.
 *
 * Routes:
 *   GET  /                          redirect to the main application
 *   GET  /activate/{slug}/{token}   choose a password
 *   POST /activate/{slug}/{token}   activate
 *   GET  /{slug}                    the organization's public landing page
 *   GET  /{slug}/dashboard          the member's services after activating
 */

declare(strict_types=1);

spl_autoload_register(function ($class) {
    $prefix = 'Showcase\\';
    if (strpos($class, $prefix) !== 0) {
        return;
    }
    $file = __DIR__ . '/../src/' . substr($class, strlen($prefix)) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});

use Showcase\Api;
use Showcase\ApiException;
use Showcase\Brand;
use Showcase\Config;
use Showcase\Session;
use Showcase\View;

$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
$path   = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Support being served from a sub-directory as well as a domain root.
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
if ($base !== '' && $base !== '/' && strpos($path, $base) === 0) {
    $path = substr($path, strlen($base));
}

$segments = array_values(array_filter(explode('/', trim($path, '/')), 'strlen'));

try {
    // ---------------------------------------------------------------
    // GET /  - nothing to show at the root; the organization is the page.
    // ---------------------------------------------------------------
    if (! $segments) {
        header('Location: ' . View::appBaseUrl(), true, 302);
        exit;
    }

    // ---------------------------------------------------------------
    // /activate/{slug}/{token}
    // ---------------------------------------------------------------
    if ($segments[0] === 'activate') {
        if (count($segments) !== 3) {
            View::notFound();
        }

        [, $slug, $token] = $segments;

        $method === 'POST'
            ? submitActivation($slug, $token)
            : showActivation($slug, $token);
        exit;
    }

    // ---------------------------------------------------------------
    // /{slug} and /{slug}/dashboard
    // ---------------------------------------------------------------
    if (count($segments) > 2 || (count($segments) === 2 && $segments[1] !== 'dashboard')) {
        View::notFound();
    }

    $slug = $segments[0];
    $data = Api::org($slug);
    Brand::set($data['brand'] ?? null);

    if (empty($data['ok'])) {
        View::notFound('We could not find an organization at this address.');
    }

    if (count($segments) === 2) {
        showDashboard($slug, $data);
        exit;
    }

    View::render('org', [
        'title'    => $data['org']['name'],
        'org'      => $data['org'],
        'services' => $data['services'],
    ]);
} catch (ApiException $e) {
    // The application could not be reached. Say so plainly - a member has no
    // use for a stack trace, and the detail only shows with APP_DEBUG on.
    http_response_code(503);
    View::render('error', [
        'title'   => 'We are having trouble connecting',
        'message' => 'We could not reach iWILL \'til i\'mWELL right now. Please try again in a few minutes.',
        'detail'  => (Config::get('APP_DEBUG') === 'true') ? $e->getMessage() : null,
    ]);
} catch (\Throwable $e) {
    http_response_code(500);
    View::render('error', [
        'title'   => 'Something went wrong',
        'message' => 'We could not load this page right now. Please try again shortly.',
        'detail'  => (Config::get('APP_DEBUG') === 'true') ? $e->getMessage() : null,
    ]);
}

// -------------------------------------------------------------------
// Handlers
// -------------------------------------------------------------------

/** The password form behind an activation link. */
function showActivation($slug, $token)
{
    $data = Api::activation($slug, $token);
    Brand::set($data['brand'] ?? null);

    if (($data['_status'] ?? 200) === 404) {
        View::notFound('We could not find an organization at this address.');
    }

    if (empty($data['ok'])) {
        renderInvalid($data);
    }

    View::render('activate', [
        'title'  => 'Activate your account',
        'org'    => $data['org'],
        'member' => $data['member'],
        'token'  => $token,
        'error'  => null,
        'csrf'   => Session::csrfToken(),
    ]);
}

/** Chosen password submitted: activate through the API. */
function submitActivation($slug, $token)
{
    if (! Session::csrfValid($_POST['_token'] ?? null)) {
        // A stale form, usually a back button or a very old tab.
        header('Location: ' . View::activateUrl($slug, $token), true, 302);
        exit;
    }

    $data = Api::activate(
        $slug,
        $token,
        (string) ($_POST['password'] ?? ''),
        (string) ($_POST['password_confirmation'] ?? '')
    );

    Brand::set($data['brand'] ?? null);

    if (($data['_status'] ?? 200) === 404) {
        View::notFound('We could not find an organization at this address.');
    }

    // The password itself was refused - show the form again with the reason.
    if (empty($data['ok']) && ($data['error'] ?? '') === 'validation') {
        $lookup = Api::activation($slug, $token);
        Brand::set($lookup['brand'] ?? null);

        View::render('activate', [
            'title'  => 'Activate your account',
            'org'    => $lookup['org'] ?? $data['org'] ?? [],
            'member' => $lookup['member'] ?? ['first_name' => '', 'email' => ''],
            'token'  => $token,
            'error'  => $data['message'] ?? 'Please check your password and try again.',
            'csrf'   => Session::csrfToken(),
        ]);
        exit;
    }

    if (empty($data['ok'])) {
        renderInvalid($data);
    }

    // Activated. Hold the ticket in this browser rather than in the URL, then
    // send them to their dashboard.
    Session::rememberActivation($slug, [
        'ticket' => $data['ticket'] ?? null,
        'name'   => $data['member']['first_name'] ?? '',
    ]);

    header('Location: ' . View::dashboardUrl($slug) . '?welcome=1', true, 302);
    exit;
}

/**
 * The member's dashboard: every service their organization switched on.
 *
 * Reachable without having just activated - it says nothing that the public
 * landing page does not. The difference is the button: with a ticket it walks
 * straight into the application, without one it goes to the sign-in page.
 */
function showDashboard($slug, array $data)
{
    // Activating on the main application (an older email link) finishes here
    // with the ticket in the query string. Move it into the session and drop
    // it from the URL, so it is not left in history or a referrer header.
    if (! empty($_GET['ticket'])) {
        Session::rememberActivation($slug, ['ticket' => (string) $_GET['ticket'], 'name' => '']);

        header('Location: ' . View::dashboardUrl($slug) . '?welcome=1', true, 302);
        exit;
    }

    $activation = Session::activation($slug);

    View::render('dashboard', [
        'title'    => $data['org']['name'] . ' - your services',
        'org'      => $data['org'],
        'services' => $data['services'],
        'ticket'   => $activation['ticket'] ?? null,
        'name'     => $activation['name'] ?? '',
        'welcome'  => isset($_GET['welcome']),
    ]);
}

/** A link that is spent, expired or simply wrong. */
function renderInvalid(array $data)
{
    http_response_code(410);
    View::render('activate-invalid', [
        'title'   => 'This link is no longer valid',
        'org'     => $data['org'] ?? [],
        'message' => $data['message'] ?? 'This activation link is no longer valid.',
    ]);
    exit;
}

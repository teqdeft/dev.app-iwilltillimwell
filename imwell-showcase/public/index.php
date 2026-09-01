<?php

/**
 * imwell.app - organization landing page.
 *
 * One dynamic page. Members arrive here after activating their account on the
 * main application, see who provides their benefits and what is included, then
 * press a button to go back to the main application.
 *
 * There is no sign in and no activation here: both live in the main app, which
 * signs the member in before sending them over. This site therefore never
 * writes to the database and keeps no session of its own.
 *
 * Routes:
 *   GET /            redirect to the main application
 *   GET /{slug}      the organization's landing page
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

use Showcase\Config;
use Showcase\Repository;
use Showcase\View;

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Support being served from a sub-directory as well as a domain root.
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
if ($base !== '' && strpos($path, $base) === 0) {
    $path = substr($path, strlen($base));
}

$segments = array_values(array_filter(explode('/', trim($path, '/')), 'strlen'));

try {
    // Nothing to show at the root - the organization is the page.
    if (! $segments) {
        header('Location: ' . rtrim(Config::get('APP_URL', 'https://app.iwilltilimwell.com'), '/'), true, 302);
        exit;
    }

    // Only /{slug}. Anything deeper belonged to the old sign-in and activation
    // pages, which now live in the main application.
    if (count($segments) > 1) {
        View::notFound();
    }

    $org = Repository::organizationBySlug($segments[0]);

    if (! $org) {
        View::notFound('We could not find an organization at this address.');
    }

    View::render('org', [
        'title'    => $org['name'],
        'org'      => $org,
        'services' => Repository::services($org['id']),
    ]);
} catch (\Throwable $e) {
    http_response_code(500);
    View::render('error', [
        'title'   => 'Something went wrong',
        'message' => 'We could not load this page right now. Please try again shortly.',
        'detail'  => (Config::get('APP_DEBUG') === 'true') ? $e->getMessage() : null,
    ]);
}

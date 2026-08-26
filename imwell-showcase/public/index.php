<?php

/**
 * imwell.app - showcase front controller.
 *
 * Routes:
 *   GET  /                          directory of organizations
 *   GET  /{slug}                    organization landing page
 *   GET  /{slug}/login              sign in (branded)
 *   POST /{slug}/login
 *   GET  /{slug}/activate/{token}   set a password for an imported member
 *   POST /{slug}/activate/{token}
 *   POST /{slug}/logout
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

use Showcase\Repository;
use Showcase\Session;
use Showcase\View;

Session::start();

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Support being served from a sub-directory as well as a domain root.
$base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
if ($base !== '' && strpos($path, $base) === 0) {
    $path = substr($path, strlen($base));
}

$segments = array_values(array_filter(explode('/', trim($path, '/')), 'strlen'));
$method   = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

try {
    // ---------------------------------------------------------- directory
    if (! $segments) {
        View::render('home', [
            'title' => 'iMWELL',
            'orgs'  => Repository::organizations(),
        ]);
        exit;
    }

    $slug = $segments[0];
    $org  = Repository::organizationBySlug($slug);

    if (! $org) {
        View::notFound('We could not find an organization at this address.');
    }

    $action = $segments[1] ?? null;

    // ------------------------------------------------------------- logout
    if ($action === 'logout' && $method === 'POST') {
        Session::logout();
        header('Location: /' . rawurlencode($slug));
        exit;
    }

    // ----------------------------------------------------------- activate
    if ($action === 'activate') {
        $token      = $segments[2] ?? '';
        $activation = Repository::findActivation($token, $org['id']);

        if (! $activation) {
            View::render('activate-invalid', [
                'title' => 'Link expired - ' . $org['name'],
                'org'   => $org,
            ]);
            exit;
        }

        $errors = [];

        if ($method === 'POST') {
            if (! Session::checkCsrf($_POST['_token'] ?? null)) {
                $errors[] = 'Your session expired. Please try again.';
            } else {
                $password = (string) ($_POST['password'] ?? '');
                $confirm  = (string) ($_POST['password_confirmation'] ?? '');

                if (strlen($password) < 8) {
                    $errors[] = 'Please choose a password of at least 8 characters.';
                } elseif ($password !== $confirm) {
                    $errors[] = 'The two passwords do not match.';
                } else {
                    Repository::activate($activation['id'], $activation['user_id'], $password);

                    $member = Repository::findMemberByEmail($activation['email'], $org['id']);
                    if ($member) {
                        Session::login($member, $slug);
                    }

                    Session::flash('success', 'Your account is active. Welcome to ' . $org['name'] . '.');
                    header('Location: /' . rawurlencode($slug));
                    exit;
                }
            }
        }

        View::render('activate', [
            'title'      => 'Activate your account - ' . $org['name'],
            'org'        => $org,
            'activation' => $activation,
            'token'      => $token,
            'errors'     => $errors,
        ]);
        exit;
    }

    // -------------------------------------------------------------- login
    if ($action === 'login') {
        if (Session::member($slug)) {
            header('Location: /' . rawurlencode($slug));
            exit;
        }

        $errors = [];
        $email  = '';

        if ($method === 'POST') {
            $email    = trim((string) ($_POST['email'] ?? ''));
            $password = (string) ($_POST['password'] ?? '');

            if (! Session::checkCsrf($_POST['_token'] ?? null)) {
                $errors[] = 'Your session expired. Please try again.';
            } else {
                $member = Repository::findMemberByEmail($email, $org['id']);

                // One message for every failure, so this page cannot be used
                // to discover which addresses belong to which organization.
                if (! $member || ! password_verify($password, (string) $member['password'])) {
                    $errors[] = 'These credentials do not match our records for this organization.';
                } elseif ((int) $member['status'] !== 1) {
                    $errors[] = 'Your account is not active yet. Please use the activation link we emailed you.';
                } else {
                    Session::login($member, $slug);
                    header('Location: /' . rawurlencode($slug));
                    exit;
                }
            }
        }

        View::render('login', [
            'title'  => 'Sign in - ' . $org['name'],
            'org'    => $org,
            'errors' => $errors,
            'email'  => $email,
        ]);
        exit;
    }

    // ----------------------------------------------- organization landing
    if ($action === null) {
        View::render('org', [
            'title'    => $org['name'],
            'org'      => $org,
            'services' => Repository::services($org['id']),
            'member'   => Session::member($slug),
            'success'  => Session::flash('success'),
        ]);
        exit;
    }

    View::notFound();
} catch (\Throwable $e) {
    http_response_code(500);
    View::render('error', [
        'title'   => 'Something went wrong',
        'message' => 'We could not load this page right now. Please try again shortly.',
        'detail'  => (Showcase\Config::get('APP_DEBUG') === 'true') ? $e->getMessage() : null,
    ]);
}

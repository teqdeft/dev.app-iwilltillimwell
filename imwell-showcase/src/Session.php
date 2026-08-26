<?php

namespace Showcase;

/**
 * A small session for the showcase site.
 *
 * This session belongs to imwell.app only. It is NOT shared with the main
 * application - browsers cannot share cookies across different root domains -
 * so signing in here does not sign the member into the main app. The
 * "Continue to the app" button sends them there to sign in once.
 */
class Session
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_name('imwell_showcase');
            session_start();
        }
    }

    public static function login(array $user, $orgSlug)
    {
        static::start();
        session_regenerate_id(true);

        $_SESSION['member'] = [
            'id'    => $user['id'],
            'name'  => $user['name'] ?: trim($user['fname'] . ' ' . $user['lname']),
            'fname' => $user['fname'],
            'email' => $user['email'],
            'org'   => $orgSlug,
        ];
    }

    public static function member($orgSlug = null)
    {
        static::start();

        $member = $_SESSION['member'] ?? null;

        if (! $member) {
            return null;
        }

        if ($orgSlug !== null && $member['org'] !== $orgSlug) {
            return null;
        }

        return $member;
    }

    public static function logout()
    {
        static::start();
        $_SESSION = [];
        session_destroy();
    }

    public static function flash($key, $value = null)
    {
        static::start();

        if ($value === null) {
            $v = $_SESSION['flash'][$key] ?? null;
            unset($_SESSION['flash'][$key]);
            return $v;
        }

        $_SESSION['flash'][$key] = $value;
    }

    public static function csrf()
    {
        static::start();

        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf'];
    }

    public static function checkCsrf($token)
    {
        static::start();

        return ! empty($_SESSION['csrf']) && is_string($token)
            && hash_equals($_SESSION['csrf'], $token);
    }
}

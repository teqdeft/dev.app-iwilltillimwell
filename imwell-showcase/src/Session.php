<?php

namespace Showcase;

/**
 * A very small session, used for two things only:
 *
 *  - a CSRF token for the activation form
 *  - the hand-off ticket returned by the API, held between activating and
 *    pressing "Continue to the app"
 *
 * It is not a sign-in. Nothing here identifies the member to the main
 * application; only the one-time ticket does, and that is spent the moment it
 * is used.
 */
class Session
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        $secure = (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');

        session_set_cookie_params([
            'lifetime' => 0,
            'path'     => '/',
            'secure'   => $secure,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        session_name('imwell_app');
        session_start();
    }

    public static function get($key, $default = null)
    {
        static::start();

        return $_SESSION[$key] ?? $default;
    }

    public static function put($key, $value)
    {
        static::start();
        $_SESSION[$key] = $value;
    }

    public static function forget($key)
    {
        static::start();
        unset($_SESSION[$key]);
    }

    /**
     * Remember that this browser just activated, and how to walk into the
     * application. Kept per organization so two links opened in one browser
     * cannot be confused for each other.
     */
    public static function rememberActivation($slug, array $data)
    {
        $all = (array) static::get('activated', []);
        $all[$slug] = $data + ['at' => time()];
        static::put('activated', $all);
    }

    /** What we know about an activation in this browser, if anything. */
    public static function activation($slug)
    {
        $all = (array) static::get('activated', []);

        return $all[$slug] ?? null;
    }

    public static function csrfToken()
    {
        static::start();

        if (empty($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf'];
    }

    public static function csrfValid($given)
    {
        static::start();

        return ! empty($_SESSION['csrf'])
            && is_string($given)
            && hash_equals($_SESSION['csrf'], $given);
    }
}

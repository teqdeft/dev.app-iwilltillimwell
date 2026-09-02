<?php

namespace Showcase;

class View
{
    public static function render($template, array $data = [])
    {
        extract($data, EXTR_SKIP);

        ob_start();
        require __DIR__ . '/../views/' . $template . '.php';
        $content = ob_get_clean();

        require __DIR__ . '/../views/layout.php';
    }

    /** Escape for HTML output. */
    public static function e($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    // ---------------------------------------------------------------
    // URLs on this site
    // ---------------------------------------------------------------

    /**
     * This site's own base path. Empty at a domain root, '/members' when it is
     * served from a sub-directory - see the front controller, which strips the
     * same prefix off incoming requests.
     */
    public static function base()
    {
        $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');

        return $base === '/' ? '' : $base;
    }

    public static function url($path = '')
    {
        return static::base() . '/' . ltrim($path, '/');
    }

    public static function orgUrl($slug)
    {
        return static::url(rawurlencode((string) $slug));
    }

    public static function dashboardUrl($slug)
    {
        return static::url(rawurlencode((string) $slug) . '/dashboard');
    }

    public static function activateUrl($slug, $token)
    {
        return static::url('activate/' . rawurlencode((string) $slug) . '/' . rawurlencode((string) $token));
    }

    // ---------------------------------------------------------------
    // URLs on the main application
    // ---------------------------------------------------------------

    /** Root of the main application. */
    public static function appBaseUrl()
    {
        return Api::baseUrl();
    }

    /**
     * Where a member continues into the application.
     *
     * With a hand-off ticket - which they have right after activating - this
     * signs them in on that domain and drops them at their dashboard. Without
     * one it is their organization's branded sign-in page, never the generic
     * app root.
     */
    public static function memberAppUrl($slug, $ticket = null)
    {
        $base = static::appBaseUrl() . '/org/' . rawurlencode((string) $slug);

        return $ticket ? $base . '/continue/' . rawurlencode((string) $ticket) : $base;
    }

    /** Deep link to one service inside the application. */
    public static function servicePath($path)
    {
        return $path ? static::appBaseUrl() . '/' . ltrim($path, '/') : null;
    }

    public static function notFound($message = 'Page not found')
    {
        http_response_code(404);
        static::render('error', ['title' => 'Not found', 'message' => $message]);
        exit;
    }
}

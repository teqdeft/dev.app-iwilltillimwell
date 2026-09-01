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

    /** Root of the main application. */
    public static function appBaseUrl()
    {
        return rtrim(Config::get('APP_URL', 'https://app.iwilltilimwell.com'), '/');
    }

    /**
     * Where a member continues into the real application: their organization's
     * own branded sign-in page, not the generic app root. The main app sends
     * them straight to the dashboard when they already have a session there,
     * which they do right after activating.
     */
    public static function memberAppUrl($slug)
    {
        return static::appBaseUrl() . '/org/' . rawurlencode((string) $slug);
    }

    /**
     * Organization logos are uploaded through the main application and live
     * under its public/ directory, so they are served from the main app's URL.
     */
    public static function logoUrl($logo)
    {
        if (! $logo) {
            return null;
        }

        if (preg_match('#^https?://#i', $logo)) {
            return $logo;
        }

        return static::appBaseUrl() . '/' . ltrim($logo, '/');
    }

    public static function notFound($message = 'Page not found')
    {
        http_response_code(404);
        static::render('error', ['title' => 'Not found', 'message' => $message]);
        exit;
    }
}

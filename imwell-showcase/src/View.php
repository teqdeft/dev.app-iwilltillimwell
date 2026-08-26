<?php

namespace Showcase;

class View
{
    public static function render($template, array $data = [])
    {
        $data['appUrl']      = rtrim(Config::get('APP_URL', 'https://app.iwilltilimwell.com'), '/');
        $data['showcaseUrl'] = rtrim(Config::get('SHOWCASE_URL', ''), '/');
        $data['csrf']        = Session::csrf();

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

        return rtrim(Config::get('APP_URL', ''), '/') . '/' . ltrim($logo, '/');
    }

    public static function notFound($message = 'Page not found')
    {
        http_response_code(404);
        static::render('error', ['title' => 'Not found', 'message' => $message]);
        exit;
    }
}

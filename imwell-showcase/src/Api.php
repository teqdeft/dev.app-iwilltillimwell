<?php

namespace Showcase;

/**
 * The only way this site reaches the main application.
 *
 * There are no database credentials here on purpose. Activation sets a
 * password, grants organization access, writes the sponsored subscription and
 * registers the member on Lyric - rules that live in the main application and
 * would rot instantly if they were reimplemented in raw SQL on a second
 * domain. So this site asks, and the application decides.
 *
 * Every request carries the shared secret as X-Imwell-Key.
 */
class Api
{
    /** Seconds to wait on the main application before giving up. */
    const TIMEOUT = 15;

    // ---------------------------------------------------------------
    // Endpoints
    // ---------------------------------------------------------------

    /** Organization + the services it has enabled. */
    public static function org($slug)
    {
        return static::request('GET', '/api/imwell/org/' . rawurlencode($slug));
    }

    /** Look up an activation link before showing the password form. */
    public static function activation($slug, $token)
    {
        return static::request('GET', '/api/imwell/org/' . rawurlencode($slug)
            . '/activation/' . rawurlencode($token));
    }

    /** Spend an activation link: sets the member's password and activates. */
    public static function activate($slug, $token, $password, $confirmation)
    {
        return static::request('POST', '/api/imwell/org/' . rawurlencode($slug)
            . '/activation/' . rawurlencode($token), [
                'password'              => $password,
                'password_confirmation' => $confirmation,
            ]);
    }

    // ---------------------------------------------------------------

    public static function baseUrl()
    {
        return rtrim(Config::get('APP_URL', 'https://app.iwilltilimwell.com'), '/');
    }

    public static function secret()
    {
        return (string) Config::get('IMWELL_SHOWCASE_SECRET', '');
    }

    /**
     * @return array The decoded body, plus '_status' with the HTTP code.
     * @throws ApiException when the application cannot be reached or answers
     *                      with something that is not JSON.
     */
    protected static function request($method, $path, array $body = null)
    {
        $secret = static::secret();

        if ($secret === '') {
            throw new ApiException(
                'IMWELL_SHOWCASE_SECRET is not set. Copy .env.example to .env and use the '
                . 'same value as the main application.'
            );
        }

        $url = static::baseUrl() . $path;
        $ch  = curl_init($url);

        $headers = [
            'Accept: application/json',
            'X-Imwell-Key: ' . $secret,
        ];

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_TIMEOUT        => static::TIMEOUT,
            CURLOPT_CONNECTTIMEOUT => 8,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
        ];

        if ($body !== null) {
            $options[CURLOPT_POSTFIELDS] = json_encode($body);
            $headers[] = 'Content-Type: application/json';
        }

        $options[CURLOPT_HTTPHEADER] = $headers;
        curl_setopt_array($ch, $options);

        $raw    = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error  = curl_error($ch);
        curl_close($ch);

        if ($raw === false) {
            throw new ApiException('Could not reach the application: ' . $error);
        }

        $decoded = json_decode($raw, true);

        if (! is_array($decoded)) {
            // A 500 page, a WAF block, a redirect to a login screen - anything
            // that is not our JSON. Say so rather than render an empty page.
            throw new ApiException('Unexpected response from the application (HTTP ' . $status . ').');
        }

        // A rejected or unconfigured key is OUR problem, not an answer about
        // the organization. Raise it, so a bad secret shows as "we cannot
        // connect" instead of quietly turning every organization into a 404.
        if (in_array($status, [401, 403, 503], true)) {
            throw new ApiException(
                'The application refused this request (HTTP ' . $status . '): '
                . ($decoded['message'] ?? 'no reason given')
                . ' Check that IMWELL_SHOWCASE_SECRET matches on both sites.'
            );
        }

        $decoded['_status'] = $status;

        return $decoded;
    }
}

/** Transport-level failure: the application could not be asked at all. */
class ApiException extends \RuntimeException
{
}

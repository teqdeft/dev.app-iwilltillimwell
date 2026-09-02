<?php

namespace Showcase;

/**
 * Product branding and service icons.
 *
 * The palette, logo, favicon and hero image all arrive from the main
 * application (Catalog::brand()) with every API response, so this site never
 * hard-codes an asset path or a colour. Change the login stylesheet and the
 * module config over there and this site follows.
 *
 * The icons are the one thing that does live here: they are inline SVG so the
 * pages stay self-contained - no icon font, no CDN, nothing to fail. A feature
 * added to the module config that has no icon here still renders, with the
 * fallback mark.
 */
class Brand
{
    /** Set once per request from the API payload. */
    protected static $data = [];

    public static function set(array $brand = null)
    {
        if ($brand) {
            static::$data = $brand;
        }
    }

    public static function get($key, $default = null)
    {
        return isset(static::$data[$key]) && static::$data[$key] !== ''
            ? static::$data[$key]
            : $default;
    }

    public static function name()      { return static::get('name', 'imwell'); }
    /** The lotus symbol. The name itself is set as text beside it. */
    public static function markUrl()   { return static::get('mark_url'); }
    public static function faviconUrl(){ return static::get('favicon_url'); }
    public static function heroUrl()   { return static::get('hero_url'); }
    public static function support()   { return static::get('support', 'support@iwilltilimwell.com'); }

    /** The product purple. Chrome, buttons and links use this. */
    public static function primary()   { return static::get('primary', '#6D578F'); }
    public static function accent()    { return static::get('accent', '#9f50b6'); }

    /**
     * The organization's own colour when the admin set one, otherwise the
     * product purple - so an org without a colour looks native rather than
     * washed out by some invented default.
     */
    public static function orgColor(array $org = null)
    {
        return ! empty($org['primary_color']) ? $org['primary_color'] : static::primary();
    }

    // ---------------------------------------------------------------

    /**
     * 24x24 stroke icons, drawn with currentColor so they take the colour of
     * whatever they sit in.
     */
    const ICONS = [
        'medical_care' =>
            '<rect x="3" y="3" width="18" height="18" rx="5"/><path d="M12 8v8M8 12h8"/>',

        'health_record' =>
            '<rect x="4" y="3" width="16" height="18" rx="3"/><path d="M8.5 8h7M8.5 12h7M8.5 16h4"/>',

        'mental_health' =>
            '<path d="M12 20s-7-4.35-7-9.15A4.05 4.05 0 0 1 12 7.4a4.05 4.05 0 0 1 7 3.45C19 15.65 12 20 12 20z"/>',

        'care_coordination' =>
            '<circle cx="9" cy="8" r="3"/><path d="M3.6 19.6a5.5 5.5 0 0 1 10.8 0"/>'
          . '<path d="M16 5.6a3 3 0 0 1 0 5.8"/><path d="M17.4 14.1a5.6 5.6 0 0 1 3 4.4"/>',

        'message_specialist' =>
            '<path d="M20 14.6a3 3 0 0 1-3 3H8.6L4.5 20.6V6.4a3 3 0 0 1 3-3H17a3 3 0 0 1 3 3z"/>'
          . '<path d="M8.6 9.4h7.2M8.6 12.8h4.4"/>',

        'pets' =>
            '<circle cx="6.8" cy="9.4" r="1.85"/><circle cx="11.1" cy="6.7" r="1.85"/>'
          . '<circle cx="15.6" cy="8.1" r="1.85"/><circle cx="18.3" cy="12.4" r="1.7"/>'
          . '<path d="M11.4 12.4c2.3 0 4.3 2 4.3 4.2 0 1.7-1.2 2.8-2.9 2.8-1 0-1.5-.4-2.5-.4'
          . 's-1.5.4-2.5.4c-1.7 0-2.9-1.1-2.9-2.8 0-2.2 2.2-4.2 4.5-4.2z"/>',

        // Anything the module adds later that has no icon here.
        'fallback' =>
            '<circle cx="12" cy="12" r="8.5"/><path d="M8.8 12.2l2.2 2.2 4.2-4.4"/>',
    ];

    public static function icon($key, $size = 24)
    {
        $path = static::ICONS[$key] ?? static::ICONS['fallback'];

        return '<svg viewBox="0 0 24 24" width="' . (int) $size . '" height="' . (int) $size . '"'
             . ' fill="none" stroke="currentColor" stroke-width="1.7"'
             . ' stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">'
             . $path . '</svg>';
    }
}

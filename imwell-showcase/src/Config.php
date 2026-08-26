<?php

namespace Showcase;

/**
 * Configuration for the imwell.app showcase site.
 *
 * Reads its own .env if present, otherwise falls back to the main
 * application's .env so both sites talk to the same database without the
 * credentials being duplicated.
 */
class Config
{
    protected static $values;

    public static function load()
    {
        if (static::$values !== null) {
            return static::$values;
        }

        static::$values = [];

        $candidates = [
            __DIR__ . '/../.env',        // showcase-specific overrides
            __DIR__ . '/../../.env',     // the main application's .env
        ];

        foreach (array_reverse($candidates) as $path) {
            if (is_file($path)) {
                static::$values = array_merge(static::$values, static::parse($path));
            }
        }

        return static::$values;
    }

    public static function get($key, $default = null)
    {
        $values = static::load();

        return array_key_exists($key, $values) && $values[$key] !== ''
            ? $values[$key]
            : $default;
    }

    protected static function parse($path)
    {
        $out = [];

        foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            $line = trim($line);

            if ($line === '' || $line[0] === '#') {
                continue;
            }

            $pos = strpos($line, '=');

            if ($pos === false) {
                continue;
            }

            $key   = trim(substr($line, 0, $pos));
            $value = trim(substr($line, $pos + 1));

            // strip surrounding quotes and any trailing inline comment
            if (strlen($value) > 1
                && (($value[0] === '"' && substr($value, -1) === '"')
                 || ($value[0] === "'" && substr($value, -1) === "'"))) {
                $value = substr($value, 1, -1);
            }

            $out[$key] = $value;
        }

        return $out;
    }
}

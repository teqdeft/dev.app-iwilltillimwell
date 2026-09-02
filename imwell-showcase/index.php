<?php

/**
 * Shim for hosts where the document root cannot be moved to public/.
 *
 * cPanel will not let you repoint the primary domain's public_html, so this
 * folder is often dropped in as public_html itself. Serving from here is only
 * safe together with the .htaccess beside this file, which blocks src/, views/
 * and .env from being fetched over HTTP.
 *
 * Preferred layout is still document root -> imwell-showcase/public.
 */

require __DIR__ . '/public/index.php';

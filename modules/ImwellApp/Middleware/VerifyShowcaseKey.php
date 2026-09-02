<?php

namespace Modules\ImwellApp\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Guards /api/imwell/*, the endpoints imwell.app calls.
 *
 * Those endpoints set passwords and activate accounts, so this FAILS CLOSED:
 * with no secret configured nothing is reachable, rather than everything.
 *
 * hash_equals() so a wrong key cannot be found a character at a time.
 */
class VerifyShowcaseKey
{
    public function handle(Request $request, Closure $next)
    {
        $expected = (string) config('imwellapp.showcase_secret', '');

        if ($expected === '') {
            return response()->json([
                'ok'      => false,
                'error'   => 'not_configured',
                'message' => 'This endpoint is not configured. Set IMWELL_SHOWCASE_SECRET.',
            ], 503);
        }

        $given = (string) ($request->header('X-Imwell-Key') ?: $request->input('key', ''));

        if ($given === '' || ! hash_equals($expected, $given)) {
            return response()->json([
                'ok'      => false,
                'error'   => 'unauthorized',
                'message' => 'Invalid API key.',
            ], 401);
        }

        return $next($request);
    }
}

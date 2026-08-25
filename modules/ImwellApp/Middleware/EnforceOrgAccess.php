<?php

namespace Modules\ImwellApp\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\ImwellApp\Support\Features;

/**
 * Restricts ImWell organisation members to the features their admin enabled.
 *
 * Pushed onto the "web" middleware group from the module's RouterServiceProvider
 * so App\Http\Kernel is never edited.
 *
 * SAFETY: this is a no-op for anyone who is not an org member. Guests and every
 * existing user (imwell_org_id = NULL) fall straight through on the first two
 * checks, so current behaviour is unchanged for them.
 */
class EnforceOrgAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        if (empty($user->imwell_org_id)) {
            return $next($request);
        }

        $org = Features::currentOrg();

        // Organisation removed or deactivated after the member signed in.
        if (! $org || ! $org->status) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/')->withErrors([
                'email' => 'Your organization account is no longer active.',
            ]);
        }

        $feature = Features::forRequest($request);

        // Path belongs to no gated feature - always allowed.
        if (! $feature) {
            return $next($request);
        }

        if (in_array($feature['key'], Features::currentKeys(), true)) {
            return $next($request);
        }

        // Feature disabled for this organisation.
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status'  => false,
                'message' => $feature['label'] . ' is not available for your organization.',
            ], 403);
        }

        return redirect('/dashboard')->with(
            'error',
            $feature['label'] . ' is not available for your organization.'
        );
    }
}

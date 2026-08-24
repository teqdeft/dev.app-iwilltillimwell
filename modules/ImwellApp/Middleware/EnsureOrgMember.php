<?php

namespace Modules\ImwellApp\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\ImwellApp\Models\ImwellOrg;

/**
 * Confirms the authenticated user actually belongs to the organisation that
 * owns the slug in the URL. Prevents a member of org A opening org B's area.
 */
class EnsureOrgMember
{
    public function handle(Request $request, Closure $next)
    {
        $slug = $request->route('slug');
        $org  = ImwellOrg::where('slug', $slug)->where('status', 1)->first();

        if (! $org) {
            abort(404);
        }

        $user = Auth::user();

        if (! $user || (int) $user->imwell_org_id !== (int) $org->id) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->to('/org/' . $slug)
                ->withErrors(['email' => 'You do not have access to this organization.']);
        }

        // Share for controllers, middleware and views downstream.
        $request->attributes->set('imwellOrg', $org);
        view()->share('imwellOrg', $org);

        return $next($request);
    }
}

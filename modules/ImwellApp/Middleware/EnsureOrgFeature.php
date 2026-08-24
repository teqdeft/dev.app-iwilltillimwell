<?php

namespace Modules\ImwellApp\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\ImwellApp\Models\ImwellOrg;
use Modules\ImwellApp\Support\Features;

/**
 * Blocks pages whose feature the admin has NOT enabled for this organisation.
 * Runs after EnsureOrgMember, so the org is already resolved.
 */
class EnsureOrgFeature
{
    public function handle(Request $request, Closure $next)
    {
        /** @var ImwellOrg|null $org */
        $org  = $request->attributes->get('imwellOrg');
        $page = $request->route('page');

        if (! $org) {
            abort(404);
        }

        $feature = Features::byPage($page);

        if (! $feature) {
            abort(404);
        }

        if (! empty($feature['always'])) {
            return $next($request);
        }

        if (! $org->hasFeature($feature['key'])) {
            abort(403, 'This feature is not enabled for your organization.');
        }

        $request->attributes->set('imwellFeature', $feature);

        return $next($request);
    }
}

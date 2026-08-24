<?php

namespace Modules\ImwellApp\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ImwellApp\Support\Features;

/**
 * The member-facing app that lives under /org/{slug}.
 *
 * Access is already guaranteed by the time a request reaches here:
 *   auth                 -> signed in
 *   imwell_org_member    -> belongs to THIS organisation
 *   imwell_org_feature   -> the admin enabled this page for the organisation
 */
class OrgAppController extends Controller
{
    public function dashboard(Request $request, $slug)
    {
        $org = $request->attributes->get('imwellOrg');

        return view('ImwellApp::app.dashboard', [
            'org' => $org,
            'nav' => Features::navFor($org),
        ]);
    }

    public function page(Request $request, $slug, $page)
    {
        $org     = $request->attributes->get('imwellOrg');
        $feature = $request->attributes->get('imwellFeature');

        // A feature can supply its own view; otherwise the shared shell is
        // used, so new features work before their screens are built.
        $custom = 'ImwellApp::app.features.' . str_replace('-', '_', $page);

        $view = view()->exists($custom) ? $custom : 'ImwellApp::app.feature';

        return view($view, [
            'org'     => $org,
            'feature' => $feature,
            'nav'     => Features::navFor($org),
        ]);
    }
}

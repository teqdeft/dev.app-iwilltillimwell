<?php

namespace Modules\ImwellApp\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\ImwellApp\Models\ImwellAppHandoff;
use Modules\ImwellApp\Models\ImwellOrg;
use Modules\ImwellApp\Models\ImwellOrgActivation;
use Modules\ImwellApp\Support\Lyric;
use Modules\ImwellApp\Support\OrgAccess;

/**
 * Organisation-branded authentication.
 *
 * Deliberately separate from App\Http\Controllers\Auth\LoginController: that
 * controller carries the main-app role redirects and telemedicine session
 * bootstrapping. Keeping this apart means the existing login flow is not
 * modified in any way.
 */
class OrgAuthController extends Controller
{
    public function showLogin($slug)
    {
        $org = $this->resolveOrg($slug);

        // Already signed in as a member of THIS org - go straight in.
        if (Auth::check() && (int) Auth::user()->imwell_org_id === (int) $org->id) {
            return redirect()->to(RouteServiceProvider::DASHBOARD);
        }

        return view('ImwellApp::auth.login', compact('org'));
    }

    public function login(Request $request, $slug)
    {
        $org = $this->resolveOrg($slug);

        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->only('email'));
        }

        $user = User::where('email', $request->input('email'))->first();

        // One generic message for every failure mode, so this page cannot be
        // used to discover which emails belong to which organisation.
        $generic = ['email' => 'These credentials do not match our records for this organization.'];

        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            return back()->withErrors($generic)->withInput($request->only('email'));
        }

        if ((int) $user->imwell_org_id !== (int) $org->id) {
            return back()->withErrors($generic)->withInput($request->only('email'));
        }

        if ((int) $user->status !== 1) {
            return back()
                ->withErrors(['email' => 'Your account is not active yet. Please use the activation link we emailed you.'])
                ->withInput($request->only('email'));
        }

        Auth::guard('web')->login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        // Pick up anyone whose Lyric registration did not complete earlier,
        // then open their Lyric session for the medical screens.
        Lyric::ensureMember($user, $org);
        Lyric::openSession($user);

        // Straight into the real application - no payment screen.
        return redirect()->intended(RouteServiceProvider::DASHBOARD);
    }

    public function showActivate($slug, $token)
    {
        $org        = $this->resolveOrg($slug);
        $activation = $this->resolveActivation($org, $token);

        if (! $activation) {
            return view('ImwellApp::auth.activate-invalid', compact('org'));
        }

        return view('ImwellApp::auth.activate', [
            'org'   => $org,
            'token' => $token,
            'user'  => $activation->user,
        ]);
    }

    public function activate(Request $request, $slug, $token)
    {
        $org        = $this->resolveOrg($slug);
        $activation = $this->resolveActivation($org, $token);

        if (! $activation) {
            return view('ImwellApp::auth.activate-invalid', compact('org'));
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'The two passwords do not match.',
            'password.min'       => 'Please choose a password of at least 8 characters.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = $activation->user;

        if (! $user) {
            return view('ImwellApp::auth.activate-invalid', compact('org'));
        }

        $user->password = Hash::make($request->input('password'));
        $user->status   = 1;
        $user->save();

        // Org members are paid for by their organization - open the real app
        // for them so they are never sent through checkout. EnforceOrgAccess
        // keeps this in step afterwards, whichever login they use next.
        OrgAccess::sync($user, $org);

        // Register on Lyric so consultations, health records and labs work.
        // Never fatal: a Lyric outage must not block activation, and the
        // members screen shows anyone who still needs registering.
        Lyric::ensureMember($user, $org);
        Lyric::openSession($user);

        $activation->used_at = now();
        $activation->save();

        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        // New activation emails point at imwell.app, but links from older
        // emails still arrive here. Finish on the same imwell.app dashboard so
        // both routes end in the same place - carrying a ticket, because the
        // session just created here is invisible over there and the member
        // must be able to come straight back.
        if (ImwellOrg::showcaseBase() !== '') {
            $ticket = ImwellAppHandoff::issueFor($user->id, $org->id);

            return redirect()->away($org->dashboardUrl() . '?ticket=' . urlencode($ticket->token));
        }

        return redirect()
            ->to(RouteServiceProvider::DASHBOARD)
            ->with('success', 'Your account is active. Welcome to ' . $org->name . '.');
    }

    /**
     * Spend a one-time ticket issued on imwell.app and sign the member in here.
     *
     * imwell.app cannot write a session on this domain - browsers do not share
     * cookies across root domains - so a member who has just set their password
     * over there would otherwise be asked for it again the moment they pressed
     * "Continue to the app". The ticket closes that gap: short lived, single
     * use, and worthless once spent.
     */
    public function handoff(Request $request, $slug, $token)
    {
        $org = $this->resolveOrg($slug);

        $handoff = ImwellAppHandoff::with('user')
            ->where('token', $token)
            ->where('imwell_org_id', $org->id)
            ->first();

        // Expired, already spent, or the member has since left the org: fall
        // back to the org's own sign-in page rather than a dead end.
        if (! $handoff || ! $handoff->isUsable() || ! $handoff->user
            || (int) $handoff->user->imwell_org_id !== (int) $org->id) {
            return redirect()
                ->to('/org/' . $org->slug)
                ->withErrors(['email' => 'That link has expired. Please sign in to continue.']);
        }

        $user = $handoff->user;

        // Burn it first: a ticket that has been looked at is a ticket that is
        // gone, even if anything below fails.
        $handoff->used_at = now();
        $handoff->save();

        // An account deactivated between activating and pressing the button.
        // Same refusal as login(), so a ticket is never a way around it.
        if ((int) $user->status !== 1) {
            return redirect()
                ->to('/org/' . $org->slug)
                ->withErrors(['email' => 'Your account is not active. Please contact your organization.']);
        }

        // Their organization pays for them - keep them out of checkout.
        OrgAccess::sync($user, $org);

        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        Lyric::ensureMember($user, $org);
        Lyric::openSession($user);

        return redirect()
            ->to(RouteServiceProvider::DASHBOARD)
            ->with('success', 'Welcome to ' . $org->name . '.');
    }


    public function logout(Request $request, $slug)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/org/' . $slug);
    }

    // ------------------------------------------------------------------

    protected function resolveOrg($slug)
    {
        $org = ImwellOrg::where('slug', $slug)->where('status', 1)->first();

        if (! $org) {
            abort(404);
        }

        return $org;
    }

    protected function resolveActivation(ImwellOrg $org, $token)
    {
        $activation = ImwellOrgActivation::with('user')
            ->where('token', $token)
            ->where('imwell_org_id', $org->id)
            ->first();

        return ($activation && $activation->isUsable()) ? $activation : null;
    }
}

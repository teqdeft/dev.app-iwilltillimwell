<?php

namespace Modules\ImwellApp\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ImwellOrg extends Model
{
    use SoftDeletes;

    protected $table = 'imwell_orgs';

    protected $fillable = [
        'name', 'slug', 'logo', 'description',
        'contact_name', 'contact_email', 'contact_phone',
        'address', 'city', 'state', 'zip_code',
        'primary_color', 'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function features()
    {
        return $this->hasMany(ImwellOrgFeature::class, 'imwell_org_id');
    }

    public function members()
    {
        return $this->hasMany(User::class, 'imwell_org_id');
    }

    /**
     * Build a URL-safe slug from the ORGANISATION NAME itself (never a code or
     * keyword), guaranteeing uniqueness by appending -2, -3 ... on collision.
     */
    public static function makeSlug($name, $ignoreId = null)
    {
        $base = Str::slug($name);

        if ($base === '') {
            $base = 'organization';
        }

        $slug = $base;
        $suffix = 1;

        while (static::withTrashed()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $suffix++;
            $slug = $base . '-' . $suffix;
        }

        return $slug;
    }

    /** Feature keys enabled for this org, as a flat array. */
    public function enabledFeatureKeys()
    {
        return $this->features()->where('enabled', 1)->pluck('feature_key')->all();
    }

    public function hasFeature($key)
    {
        return $this->features()->where('feature_key', $key)->where('enabled', 1)->exists();
    }

    public function logoUrl()
    {
        return $this->logo ? asset($this->logo) : null;
    }

    /** This organization's entry point inside the main application. */
    public function url()
    {
        return url('/org/' . $this->slug);
    }

    /** Base URL of the showcase site, or '' when it is not configured. */
    public static function showcaseBase()
    {
        return rtrim((string) config('imwellapp.showcase_url', ''), '/');
    }

    /**
     * Where members should be sent to read about this organization: the
     * imwell.app landing page when it is configured, otherwise the main
     * application as before.
     */
    public function landingUrl()
    {
        $base = static::showcaseBase();

        return $base !== '' ? $base . '/' . $this->slug : $this->url();
    }

    /**
     * The member's service dashboard on imwell.app - where activation ends.
     * Falls back to this application's dashboard when imwell.app is not
     * configured.
     */
    public function dashboardUrl()
    {
        $base = static::showcaseBase();

        return $base !== '' ? $base . '/' . $this->slug . '/dashboard' : url('/dashboard');
    }

    /**
     * Where an activation link should point.
     *
     * imwell.app when it is configured: the member chooses their password
     * there and lands on their organization's dashboard there. The equivalent
     * screen on this application stays live either way, so links in already
     * delivered emails keep working.
     */
    public function activationUrl($token)
    {
        $base = static::showcaseBase();

        if ($base !== '') {
            return $base . '/activate/' . $this->slug . '/' . $token;
        }

        return url('/org/' . $this->slug . '/activate/' . $token);
    }

    /**
     * Spend a one-time ticket to arrive on this application already signed in.
     * imwell.app cannot create a session on this domain, so this is how a
     * member crosses from there to here without a second password prompt.
     */
    public function handoffUrl($token)
    {
        return url('/org/' . $this->slug . '/continue/' . $token);
    }
}

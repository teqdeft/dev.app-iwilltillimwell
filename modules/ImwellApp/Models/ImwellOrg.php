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

    public function url()
    {
        return url('/org/' . $this->slug);
    }
}

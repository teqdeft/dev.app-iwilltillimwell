<?php

namespace Modules\ImwellApp\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ImwellOrgActivation extends Model
{
    protected $table = 'imwell_org_activations';

    protected $fillable = ['user_id', 'imwell_org_id', 'token', 'expires_at', 'used_at'];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at'    => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function org()
    {
        return $this->belongsTo(ImwellOrg::class, 'imwell_org_id');
    }

    public static function issueFor($userId, $orgId, $days = 14)
    {
        // Any earlier unused token for this member is invalidated.
        static::where('user_id', $userId)->whereNull('used_at')->delete();

        return static::create([
            'user_id'       => $userId,
            'imwell_org_id' => $orgId,
            'token'         => Str::random(64),
            'expires_at'    => now()->addDays($days),
        ]);
    }

    public function isUsable()
    {
        return is_null($this->used_at)
            && (is_null($this->expires_at) || $this->expires_at->isFuture());
    }
}

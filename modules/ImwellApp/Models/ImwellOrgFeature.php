<?php

namespace Modules\ImwellApp\Models;

use Illuminate\Database\Eloquent\Model;

class ImwellOrgFeature extends Model
{
    protected $table = 'imwell_org_features';

    protected $fillable = ['imwell_org_id', 'feature_key', 'enabled'];

    protected $casts = ['enabled' => 'boolean'];

    public function org()
    {
        return $this->belongsTo(ImwellOrg::class, 'imwell_org_id');
    }
}

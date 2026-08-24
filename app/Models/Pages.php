<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;
    /**
     * Get all of the Link dependents.
     */
    public function dependents()
    {
        return $this->hasMany(Pages::class, 'parent_id');
    }
    /**
     * Get parent of the dependents.
     */
    public function parent()
    {
        return $this->belongsTo(Pages::class, 'parent_id');
    }
}

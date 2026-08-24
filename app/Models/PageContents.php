<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContents extends Model
{
    use HasFactory;
    /**
     * Get all of the Link dependents.
     */
    public function dependents()
    {
        return $this->hasMany(PageContents::class, 'parent_id');
    }
    /**
     * Get parent of the dependents.
     */
    public function parent()
    {
        return $this->belongsTo(PageContents::class, 'parent_id');
    }
}

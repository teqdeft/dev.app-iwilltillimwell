<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the comments for the blog post.
     */
    public function subscriptionUsers()
    {
        return $this->belongsTo(Users::class, 'plainDetailsId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VjLinkUsers extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vj_link_users';
    
    protected $fillable = [ 
        'user_id', 
        'shared_on_email', 
        'token', 
        'status',
        'created_at',
        'updated_at'
    ];
}

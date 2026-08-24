<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VJ extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'voice_journal';
    
    protected $fillable = [ 
        'user_id', 
        'voice_text', 
        'file_name',
        'link_visitor',
        'link_visitor_email',
        'duration',
        'created_at',
        'updated_at'
    ];
}

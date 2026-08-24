<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMood extends Model
{
    use HasFactory;
    protected $fillable = ['parent_id','user_id','mood','emoji_date','type','text'];
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaftyPlanUser extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','safty_title','plan_data','created_at','updated_at' ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $with = ['checkRole'];
    public function checkRole(){
      return $this->belongsTo(Role::class,'role_id','id')->withDefault();
    }
}

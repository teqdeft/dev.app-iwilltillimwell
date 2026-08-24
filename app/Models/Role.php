<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;
    protected $with = ['checkPermission'];
    public function checkPermission(){
        return $this->hasOne(Permission::class,'id','role_id')->withDefault();
    }

    public function adminManagers(){
        return $this->belongsto(User::class,'admin_managers');
    }
}

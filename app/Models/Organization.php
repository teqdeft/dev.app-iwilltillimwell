<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;
use App\Models\User;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['name','group_email','group_analytics'];

    public function users() 
    {
      return $this->hasMany('User');
    }

}

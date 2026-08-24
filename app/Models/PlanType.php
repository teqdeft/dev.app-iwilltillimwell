<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;

class PlanType extends Model
{
    use HasFactory;

    function plan(){
        return $this->belongsTo(Plan::class,'plan_type','id');
    }

}

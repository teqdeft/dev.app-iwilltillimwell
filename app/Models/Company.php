<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyService;

class Company extends Model
{   
    use HasFactory;

    protected $with = ['company_service'];

    function company_service(){
        return $this->hasMany(CompanyService::class,'company_id','id');
    }
}

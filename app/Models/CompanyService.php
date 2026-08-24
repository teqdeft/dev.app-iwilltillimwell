<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyService extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'parent_id', 'section','type','status',
                        'title','description','image','learn_more'];
    protected $guarded = ['*'];

    function company(){
        return $this->belongsTo('App\Models\Company','company_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affirmation extends Model
{
    use HasFactory;
    protected $fillable = [ 'message','type','parent_type'];
    protected $with = ['typeName'];

    function typeName(){
        return $this->belongsTo(Affirmation::class, 'parent_type');
    }

}

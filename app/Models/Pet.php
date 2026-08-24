<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'user_id', 'pet_id','user_primary_id',
                        'species','breed','years','months','gender','sterilization'];

    
    function gender(){
        return ($this->attributes['gender'] == 'm')?'Male':'Female';
    }
    function sterilizate(){
        return ($this->attributes['gender'] == 'm')?'Neutered':'Spayed';
    }

}

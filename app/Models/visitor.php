<?php

namespace App\Models;

use App\Models\Quizanswers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class visitor extends Model
{
    use HasFactory;
    protected $table = "visitors";
    
    protected $with  = ['quizAnswer'];
    
    public function quizAnswer() {
        return $this->hasMany('App\Models\Quizanswers', 'visitor_id','id');
    }

}

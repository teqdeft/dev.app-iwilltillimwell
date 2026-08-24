<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medication extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medication';

    public function medications() {
        return $this->belongsTo(Medication::class, 'id');
    }

    public static function inComplete(){
        return Self::where(['userId' => Auth::user()->id,'complete' => 0])->first();
    }

    public static function deleteInComplete(){
        return Self::where(['userId' => Auth::user()->id,'complete' => 0])->delete();
    }

}

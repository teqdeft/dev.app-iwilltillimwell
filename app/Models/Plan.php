<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PlanType;

class Plan extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['name','amount','type','interval','auto_renewal','description'];
    protected $appends = ['amount_with_currency'];
    protected $with = ['planType'];

    public function getAmountWithCurrencyAttribute() {
        return "$".$this->attributes['amount'];
    }

    public function planType(){
        return $this->hasOne(PlanType::class,'id','plan_type')->where('status',1)->withDefault();
    }


}

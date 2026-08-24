<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class BraintreeTransaction extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'braintree_transactions';
    protected $fillable = ['user_id','plan_id','amount','status','transaction_id','promo_code_id','promo_code_amount','final_amount','pro_rata_days','pro_rata_amount'];

    function userDetails(){
        return $this->belongsTo('App\Models\User','id','user_id');
    }

}

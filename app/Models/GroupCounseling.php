<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GroupCounselingTime;
use App\Models\BraintreeTransaction;
use App\Models\User;

// https://stackoverflow.com/questions/20721977/laravel-model-relations-between-3-tables


class GroupCounseling extends Model
{
    use HasFactory;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "group_counselings";
    protected $with = ["getCounseler"];

    public function timeTable(){
        return $this->hasMany(GroupCounselingTime::class, 'group_counseling_id');

    }

    public function getCounseler(){
        return $this->hasOne(User::class, 'id','counseler_name');
    }

    public function sessionRegister($id){
        return $this->leftJoin('braintree_transactions as bt','bt.counseling_id','=','group_counselings.id')
                    ->leftJoin('braintree_transaction_refunds as btr','btr.transaction_id','=','bt.transaction_id')
                    ->leftJoin('users','bt.user_id','=','users.id')
                    ->where(['users.user_role' => 'user','group_counselings.id' => $id])
                    ->select('btr.type','group_counselings.created_at','users.name')->get();

    }
}

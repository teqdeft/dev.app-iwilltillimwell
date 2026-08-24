<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Promocode extends Model
{  
    use HasFactory;
    protected $fillable = [
        'code','valid_from','valid_to','influencer_id','influencer_commission_type','influencer_commission_amount',
        'allowed_members','member_discount_type','member_discount_amount','stripe_id','influencer_type'
    ];

    protected $hidden = [
        'remember_token'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['members_discount_amount', 'influencer_discount_amount'];
   
    // Influencer Commission Amount
    public function getInfluencerDiscountAmountAttribute() {
        if( isset($this->attributes['member_discount_type']) ){
            return $this->attributes['influencer_commission_type']=="fixed" ? "$".$this->attributes['influencer_commission_amount'] : $this->attributes['influencer_commission_amount']."%";    
        }
        
    }

    // Member Commission Amount
    public function getMembersDiscountAmountAttribute() {
        if( isset($this->attributes['member_discount_type']) ){
            return $this->attributes['member_discount_type']=="fixed" ? "$".$this->attributes['member_discount_amount'] : $this->attributes['member_discount_amount']."%";    
        }
    }

    public function getUser(){
        return $this->belongsTo('App\Models\User','influencer_id','id')->withDefault();
    }
    public static function getAllInfluencerWithOrg(){
            return User::leftJoin('organizations','organizations.id','=','users.organization_id')
            ->where('users.user_role','influencer')
            ->where('users.organization_id','!=','')
            ->select('users.id',DB::raw("CONCAT(organizations.name,' (',users.name,')') AS fullname"))->get();
    }
    public static function getAllInfluencer(){
        return User::where('users.user_role','influencer')
        ->where('users.organization_id','=',NULL)
        ->select('id','name as fullname')->get();
    }
}

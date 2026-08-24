<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_code_id',
        'member_id',
        'influencer_id',
        'influencer_type',
        'status',
        ];

    protected $appends = ['custom_status','commission_amount'];

    public function promocode()
    {
        return $this->belongsTo(Promocode::class, 'promo_code_id');
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function getCustomStatusAttribute()
    {
        return $this->attributes['status']==1 ? "Paid" : "Pending";
    }

    public function getCommissionAmountAttribute()
    {
        return "$".$this->attributes['influencer_payable_amount'];
    }
}

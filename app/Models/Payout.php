<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = [
        'user_id',
        'total_withdrawal',
        'grand_withdrawal',
        'paid_payout',
        'status',
        'remark'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
?>
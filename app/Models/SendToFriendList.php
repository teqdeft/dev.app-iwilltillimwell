<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SendToFriendList extends Model
{
    use HasFactory;
     protected $fillable = [
        'content','type','user_id','created_at','updated_at'
    ];

    /**
     * Get the user that owns the SendToFriendList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function UserDetails(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public static function getUserContact($user_id){
        return Self::where('user_id',$user_id)->orderBy('id','desc')->get();
    }

}

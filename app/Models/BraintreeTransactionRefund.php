<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BraintreeTransactionRefund extends Model
{
    use HasFactory;
    protected $table = 'braintree_transaction_refunds';
    protected $fillable = ['transaction_id','type','reason'];
}

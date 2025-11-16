<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'payment_details';
    protected $fillable = [
        'order_id',
        'date',
        'total',
        'method',
        'status',
        'invoice_path'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}

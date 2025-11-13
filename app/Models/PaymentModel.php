<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $fillable = ['pedido_id', 'date', 'total', 'method', 'status', 'invoicePath'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'pedido_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'detallesPedidos';
    protected $fillable = ['orden_id', 'product_id', 'quantity', 'unitPrice', 'total'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orden_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

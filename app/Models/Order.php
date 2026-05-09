<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'business_id',
        'total',
        'status',
        'shipping_address',
        'payment_method',
        'payment_status',
        'notes'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relación con el cliente (usuario)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con el negocio
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    // Relación con los detalles del pedido
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    
    // Alias para mantener compatibilidad
    public function customer()
    {
        return $this->user();
    }
}
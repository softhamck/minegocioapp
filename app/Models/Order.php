<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $fillable = ['negocio_id', 'cliente_id', 'numeroOrden', 'estado_id', 'total'];

    public function business()
    {
        return $this->belongsTo(Business::class, 'negocio_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cliente_id');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'estado_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'orden_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'pedido_id');
    }
}

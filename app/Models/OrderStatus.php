<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Catálogo de estados de pedido (tabla order_statuses).
 * La aplicación usa la columna orders.status; Order mantiene sincronizado order_statuses_id.
 */
class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_statuses';

    protected $fillable = ['name'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'order_statuses_id');
    }
}

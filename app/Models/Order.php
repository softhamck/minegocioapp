<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'notes',
        'order_statuses_id',
        'order_number',
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * La tabla orders conserva la columna heredada order_statuses_id (obligatoria).
     * Se mantiene sincronizada con la columna 'status' que usa la aplicación.
     */
    protected static function booted(): void
    {
        static::saving(function (Order $order) {
            if ($order->isDirty('status') || empty($order->order_statuses_id)) {
                $nombres = [
                    'pending' => 'Pendiente',
                    'processing' => 'Enviado',
                    'completed' => 'Completado',
                    'cancelled' => 'Cancelado',
                ];
                $nombre = $nombres[$order->status ?? 'pending'] ?? 'Pendiente';
                // Si la tabla de estados está vacía en el servidor, se crea el estado que falte
                $order->order_statuses_id = DB::table('order_statuses')->where('name', $nombre)->value('id')
                    ?? DB::table('order_statuses')->insertGetId(['name' => $nombre]);
            }
        });
    }

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
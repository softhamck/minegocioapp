<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'business_id',        
        'user_id',        
        'order_statuses_id', 
        'order_number',       
        'total'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id'); 
    }

    public function users()
    {
        return $this->belongsTo(Customer::class, 'user_id'); 
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_statuses_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id'); 
    }

    public function payments_details()
    {
        return $this->hasMany(Payment::class, 'order_id'); 
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'business_id',
        'name',
        'description',
        'price',
        'quantity',   // corregido (antes stock)
        'image',
        'active'      // corregido (antes status)
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}

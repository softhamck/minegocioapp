<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $fillable = ['negocio_id', 'name', 'description', 'price', 'quantity', 'image', 'status'];

    public function business()
    {
        return $this->belongsTo(Business::class, 'negocio_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}

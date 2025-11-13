<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = ['negocio_id', 'name', 'email', 'phone', 'address'];

    public function business()
    {
        return $this->belongsTo(Business::class, 'negocio_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'cliente_id');
    }
}

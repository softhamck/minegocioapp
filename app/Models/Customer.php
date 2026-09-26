<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Cliente registrado por una emprendedora en su negocio (tabla customers).
 */
class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = ['business_id', 'name', 'email', 'telephone', 'address'];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}

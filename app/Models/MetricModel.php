<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    use HasFactory;

    protected $table = 'metricas';
    protected $fillable = ['negocio_id', 'date', 'totalSales', 'orders', 'customers'];

    public function business()
    {
        return $this->belongsTo(Business::class, 'negocio_id');
    }
}

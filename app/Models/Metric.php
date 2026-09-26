<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Métrica diaria de un negocio (tabla metrics).
 */
class Metric extends Model
{
    use HasFactory;

    protected $table = 'metrics';

    protected $fillable = ['business_id', 'date', 'total_sales', 'orders', 'customers'];

    protected $casts = [
        'date' => 'date',
        'total_sales' => 'decimal:2',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}

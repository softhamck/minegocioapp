<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Recordatorio de un negocio (tabla reminders).
 */
class Reminder extends Model
{
    use HasFactory;

    protected $table = 'reminders';

    protected $fillable = ['business_id', 'title', 'description', 'date_reminder', 'status'];

    protected $casts = [
        'date_reminder' => 'datetime',
        'status' => 'boolean',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}

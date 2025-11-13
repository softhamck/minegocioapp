<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $table = 'recordatorios';
    protected $fillable = ['negocio_id', 'title', 'description', 'reminderDate', 'status'];

    public function business()
    {
        return $this->belongsTo(Business::class, 'negocio_id');
    }
}

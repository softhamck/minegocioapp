<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table = 'negocios';
    protected $fillable = ['usuario_id', 'name', 'description', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'negocio_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'negocio_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'negocio_id');
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class, 'negocio_id');
    }

    public function metrics()
    {
        return $this->hasMany(Metric::class, 'negocio_id');
    }
}

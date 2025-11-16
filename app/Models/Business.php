<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table = 'business';
    protected $fillable = ['usuario_id', 'name', 'description', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'business_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'business_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'business_id');
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class, 'business_id');
    }

    public function metrics()
    {
        return $this->hasMany(Metric::class, 'business_id');
    }
}

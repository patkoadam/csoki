<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chocolate extends Model
{
    use HasFactory;

    protected $table = 'chocolates';
    protected $fillable = ['brand', 'chocolate_name', 'price', 'expiry_date'];

    public function order()
    {
        return $this->hasMany(Order::class, 'chocolate_id');
    }
}

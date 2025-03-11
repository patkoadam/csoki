<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['email', 'address', 'chocolate_id', 'count', 'all_price'];

    public function chocolate()
    {
        return $this->belongsTo(Chocolate::class);
    }
}

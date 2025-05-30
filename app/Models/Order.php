<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'quantity',
        'total',
        'cash_recieved',
        'change',
    ];

    public function details() {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{
    protected $table='orders';
    protected $fillable=[
        'user_id',
        'Product',
        'Price',
        'Payment',
        'Status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

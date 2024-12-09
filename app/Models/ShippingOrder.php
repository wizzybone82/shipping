<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'package_size',
        'package_weight',
        'delivery_time',
        'pickup_time',
        'status',
        'pickup_city',
        'pickup_address',
        'delivery_city',
        'delivery_address',
        'customer_id', 
        'canceled_by',
        'number_of_items',
        'phone_number',
        'mobile_key',
        'weight_metric'
    ];

    // Optionally, if you want to handle the timestamps automatically:
    protected $dates = ['delivery_time', 'pickup_time'];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_id',
        'order_id_generate',
        'name',
        'mobile',
        'alter_mobile',
        'pin',
        'state',
        'city',
        'house_no',
        'road_name',
        'landmark',
        'address_type',
        'amount',
        'discount',
        'gst',
        'net_amount',
        'payment_method',
        'payment_gateway_id',
        'booking_type',
        'order_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
    
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    use HasFactory;

    protected $fillable = [
        'order_id',
        'seller_id',
        'product_id',
        'order_details_id_generate',
        'name',
        'list_price',
        'selling_price',
        'extra_discount',
        'special_price',
        'shipping_fee',
        'total_amount',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}


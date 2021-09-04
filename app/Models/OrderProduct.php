<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = 'order_products';
    protected $fillable =
    [
        'user_id','name','address','city','state','country','zip_code','mobile',
        'email','shipping_charges','coupon_code','coupon_amount','order_status','payment_method','payment_gateway','grand_total'
    ];
}

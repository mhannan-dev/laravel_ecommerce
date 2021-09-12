<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;
    protected $table = 'shipping_charges';
    protected $fillable =
    [
        'country','shipping_charges','status','created_at','updated_at'
    ];

    public static function getShippingCharges($country)
    {
        $shippingDetails = ShippingCharge::where('country', $country)->first()->toArray();
        $shipping_charges = $shippingDetails['shipping_charges'];
        
        return $shipping_charges;
    }
}

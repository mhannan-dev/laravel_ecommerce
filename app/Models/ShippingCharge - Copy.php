<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingCharge extends Model
{
    use HasFactory;
    protected $table = 'shipping_charges';
    protected $fillable =
    [
        'country_name', 'till_500gm', 'till_1000gm', 'till_2000gm', 'above_5000gm', 'status', 'created_at', 'updated_at'
    ];

    public static function getShippingCharges($total_weight, $country)
    {

        $shippingDetails = ShippingCharge::where('country_name', $country)->first();
        // dd($shippingDetails->till_500gm);
        //$shippingDetails = json_decode(json_encode($shippingDetails), true);
        //dd($shippingDetails['till_500gm']);
        if ($total_weight > 0) {
            if ($total_weight > 0 && $total_weight <= 500) {
                $shipping_charges = $shippingDetails->till_500gm ?? '';
            } else if ($total_weight > 501 && $total_weight <= 1000) {
                $shipping_charges = $shippingDetails->till_1000gm ?? '';
                //dd($shipping_charges);
            } else if ($total_weight > 1001 && $total_weight <= 2000) {
                $shipping_charges = $shippingDetails->till_2000gm;
            } else if ($total_weight > 2001 && $total_weight <= 5000) {
                $shipping_charges = $shippingDetails->till_5000gm;
            } else if ($total_weight > 5001) {
                $shipping_charges = $shippingDetails->above_5000gm;
            } else {
                $shipping_charges = 0;
            }
        } else {
            $shipping_charges = 0;
        }
        return $shipping_charges;
    }
}
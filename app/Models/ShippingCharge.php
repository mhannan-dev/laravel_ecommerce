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
        'country','0_500gm','501_1000gm','1001_2000gm','2001_3000gm',' 30001_4000gm','4001_5000gm','status','created_at','updated_at'
    ];
    public static function getShippingCharges($country)
    {
        $shippingDetails = ShippingCharge::where('country', $country)->first()->toArray();
        $shipping_charges = $shippingDetails['shipping_charges'];
        return $shipping_charges;
    }
}

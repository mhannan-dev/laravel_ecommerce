<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryAddress extends Model
{
    use HasFactory;

    public static function deliveryAddress()
    {
        $user_id = Auth::user()->id;
        $deliveryAddress = DeliveryAddress::where('user_id',$user_id)->get()->toArray();
        return $deliveryAddress;
    }
}

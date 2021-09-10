<?php

namespace Database\Seeders;

use App\Models\ShippingCharge;
use Illuminate\Database\Seeder;

class ShippingChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chargeRecord = [
            ['countries' => 'Bangladesh','shipping_charges'=> 70, 'status' => '1'],
            ['countries' => 'India','shipping_charges'=> 2000, 'status' => '1'],
            ['countries' => 'USA','shipping_charges'=> 5000, 'status' => '1'],
            ['countries' => 'Canada','shipping_charges'=> 7500, 'status' => '1'],
        ];
        ShippingCharge::insert($chargeRecord);
    }
}

<?php

namespace Database\Seeders;

use App\Models\DeliveryAddress;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $addressRecord = [
            [
                'user_id'=> 1,
                'name' => 'Muhammad Hannan',
                'address'=> '47 Mohakhali C/A',
                'state'=> 'Dhaka',
                'city'=> 'Dhaka',
                'country'=>'Bangladesh',
                'zip_code'=> '123',
                'mobile'=> '01744894452',
                'status' => 1
            ]

        ];
        DeliveryAddress::insert($addressRecord);
    }
}

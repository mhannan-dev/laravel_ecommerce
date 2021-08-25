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
                'address'=> 'Mohakhali',
                'city'=> 'Dhaka',
                'state'=> 'Dhaka',
                'country'=>'Bangladesh',
                'zip_code'=> '123',
                'mobile'=> '01744894452',
                'status' => 1
            ]

        ];
        DeliveryAddress::insert($addressRecord);
    }
}

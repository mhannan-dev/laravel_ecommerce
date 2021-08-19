<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponRecord = [
            [
                'coupon_option' => 'Mannual',
                'coupon_code' => 'CCT1',
                'categories' => '1,2',
                'users' => 'mdhannan.info@gmail.com',
                'coupon_type' => 'Single',
                'amount_type' => 'Percentage',
                'amount' => '10',
                'expiry_date' => '2021-09-30',
                'title' => 'Coupon one title',
                'alt_text' => 'Coupon one alt text',
                'status' => 1
            ],
            [
                'coupon_option' => 'Mannual',
                'coupon_code' => 'CCT2',
                'categories' => '1,3',
                'users' => 'ahannan.info@gmail.com,mdhannan.info@gmail.com',
                'coupon_type' => 'Single',
                'amount_type' => 'Percentage',
                'amount' => '20',
                'expiry_date' => '2021-10-31',
                'title' => 'Coupon two title',
                'alt_text' => 'Coupon two alt text',
                'status' => 1
            ],
        ];
        Coupon::insert($couponRecord);
    }
}

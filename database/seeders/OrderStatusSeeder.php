<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderStatusRecord = [
            ['name' => 'New', 'status' => 1],
            ['name' => 'Pending', 'status' => 1],
            ['name' => 'Hold', 'status' => 1],
            ['name' => 'Cancelled', 'status' => 1],
            ['name' => 'In Progress', 'status' => 1],
            ['name' => 'Paid', 'status' => 1],
            ['name' => 'Shipped', 'status' => 1],
            ['name' => 'Delivered', 'status' => 1]
        ];
        OrderStatus::insert($orderStatusRecord);
    }
}

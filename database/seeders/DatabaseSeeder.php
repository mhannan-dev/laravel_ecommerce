<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminsTableSeeder::class,
            SectionTableSeeder::class,
            CategoryTableSeeder::class,
            ProductSeeder::class,
            BrandsSeeder::class,
            BannerSeeder::class,
            CouponSeeder::class,
            //AddressSeeder::class,
            OrderStatusSeeder::class

        ]);
    }
    // public function run()
    // {
    //     $this->call(AdminsTableSeeder::class);
    //     $this->call(SectionTableSeeder::class);
    //     $this->call(CategoryTableSeeder::class);
    //     $this->call(ProductSeeder::class);
    //     $this->call(BrandsSeeder::class);
    //     $this->call(BannerSeeder::class);
    // }
}

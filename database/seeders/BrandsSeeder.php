<?php

namespace Database\Seeders;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandRecord = [
            ['title' => 'Arrow', 'slug' => 'arrow', 'status' => 1],
            ['title' => 'Gap', 'slug' => 'gap', 'status' => 1],
            ['title' => 'Lee', 'slug' => 'lee', 'status' => 1],
            ['title' => 'Monte', 'slug' => 'monte', 'status' => 1],
        ];
        Brand::insert($brandRecord);
    }
}

<?php

use App\Models\ProductsImage;
use Illuminate\Database\Seeder;

class ProductsImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImageRecord = [
            ['product_id'=>'1','images'=>'dummy1.jpg','status'=> 1],
            ['product_id'=>'1','images'=>'dummy2.jpg','status'=> 1],
            ['product_id'=>'1','images'=>'dummy1.jpg','status'=> 1],
            ['product_id'=>'2','images'=>'dummy1.jpg','status'=> 1],
            ['product_id'=>'2','images'=>'dummy2.jpg','status'=> 1],
            ['product_id'=>'2','images'=>'dummy1.jpg','status'=> 1],
        ];
        ProductsImage::insert($productImageRecord);
    }
}

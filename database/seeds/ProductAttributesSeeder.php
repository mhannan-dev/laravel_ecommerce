<?php

use App\Models\ProductAttribute;
use Illuminate\Database\Seeder;

class ProductAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributeRecord = [
            ['product_id'=>'1','size'=>'Small','price'=>120.00,'stock'=>'10','sku'=>'SKU1','status'=> 1],
            ['product_id'=>'2','size'=>'Medium','price'=>150.00,'stock'=>'10','sku'=>'SKU2','status'=> 1],
            ['product_id'=>'3','size'=>'Large','price'=>200.00,'stock'=>'10','sku'=>'SKU3','status'=> 1],
        ];
        ProductAttribute::insert($productAttributeRecord);
    }
}

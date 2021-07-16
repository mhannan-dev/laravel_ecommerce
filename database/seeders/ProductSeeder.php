<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $prdRecord = [
            [
                'section_id' => '1',
                'category_id' => '1',
                'brand_id' => '1',
                'title' => 'Product One',
                'slug' => 'product-one',
                'code' => 'PRD1',
                'color' => 'red',
                'price' => '100.00',
                'weight' => '0.00',
                'discount_amt' => '0.00',

                'image' => 'default.png',
                'description' => 'description',
                'wash_care' => 'n/a',
                'fabric' => 'fabric',
                'pattern' => 'n/a',
                'sleeve' => 'sleeve',
                'fit' => 'fit',
                'occasion' => 'occasion',
                'meta_title' => 'meta title',
                'meta_description' => 'meta_description',
                'meta_keyword' => 'meta_keyword',
                'is_featured' => 'yes',
                'status' => '1'
            ],
            [
                'section_id' => '2',
                'category_id' => '2',
                'brand_id' => '2',
                'title' => 'Product two',
                'slug' => 'product-two',
                'code' => 'PRD2',
                'color' => 'red',
                'price' => '200.00',
                'weight' => '0',
                'discount_amt' => '0.00',
                'image' => 'default.png',
                'description' => 'description',
                'wash_care' => 'n/a',
                'fabric' => 'fabric',
                'pattern' => 'n/a',
                'sleeve' => 'sleeve',
                'fit' => 'fit',
                'occasion' => 'occasion',
                'meta_title' => 'meta title',
                'meta_description' => 'meta_description',
                'meta_keyword' => 'meta_keyword',
                'is_featured' => 'yes',
                'status' => '1'
            ]


        ];
        Product::insert($prdRecord);
    }
}

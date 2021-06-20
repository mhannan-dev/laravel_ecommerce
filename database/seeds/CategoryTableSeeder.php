<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecord = [
            ['parent_id' => 0,
            'section_id' => 1,
            'title'=> 'T-Shirt',
            'slug'=> 't-shirt',
            'image'=>'default.png',
            'discount_amt'=> 0.00,
            'description'=>'description t-shirt',
            'meta_title'=> 'meta_title',
            'meta_description'=> 'meta_description',
            'status'=> 1],
            ['parent_id' => 1,
            'section_id' => 2,
            'title'=> 'f-pant',
            'slug'=> 'f-pant',
            'image'=>'default.png',
            'discount_amt'=> 0.00,
            'description'=> 'description f-pant',
            'meta_title'=> 'meta_title',
            'meta_description'=> 'meta_description',
            'status'=> 1]
        ];
        Category::insert($categoryRecord);
    }
}

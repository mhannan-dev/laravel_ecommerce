<?php
namespace Database\Seeders;
use App\Models\Brand;
use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecord = [
            ['title'=>'Banner One','alt'=>'banner-one','banner_image'=>'default.png','status'=> 1],
            ['title'=>'Banner Two','alt'=>'banner-two','banner_image'=>'default.png','status'=> 1],
            ['title'=>'Banner Three','alt'=>'banner-three','banner_image'=>'default.png','status'=> 1],
            ['title'=>'Banner Four','alt'=>'banner-four','banner_image'=>'default.png','status'=> 0]
        ];
        Banner::insert($bannerRecord);
    }
}

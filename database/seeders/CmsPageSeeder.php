<?php
namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;
class CmsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cmsPageRecord = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'description' => 'description about page',
                'meta_title' => 'meta title about page',
                'meta_description' => 'meta description about page',
                'status' => 1
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'description' => 'description about page',
                'meta_title' => 'meta title about page',
                'meta_description' => 'meta description about page',
                'status' => 1
            ]
        ];
        CmsPage::insert($cmsPageRecord);
    }
}

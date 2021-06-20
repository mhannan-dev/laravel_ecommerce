<?php

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecord = [
            ['title'=>'Men','slug'=>'men','status'=>'1'],
            ['title'=>'Women','slug'=>'women','status'=>'1'],
            ['title'=>'Kid','slug'=>'kid','status'=>'1']
        ];
        Section::insert($sectionRecord);
    }
}

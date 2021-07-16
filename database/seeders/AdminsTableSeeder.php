<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminsRecord = [
            [
                'id' => 1, 'name' => 'M Hannan', 'type' => 'admin', 'mobile' => '01744894452', 'email' => 'admin@admin.com', 'password' => Hash::make('12345678'), 'image' => '', 'status' => 1
            ],
            [
                'id' => 2, 'name' => 'Aayat', 'type' => 'admin', 'mobile' => '01744894450', 'email' => 'admin2@admin.com', 'password' => Hash::make('12345678'), 'image' => '', 'status' => 1
            ]

        ];
        DB::table('admins')->insert($adminsRecord);
    }
}

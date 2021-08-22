<?php
namespace Database\Seeders;
use App\Models\Admin\Todo;
use Illuminate\Database\Seeder;
class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $todoRecord = [
            ['title' => 'Todo One'],
            ['title' => 'Todo Two']
        ];
        Todo::insert($todoRecord);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 30; $i++)
        {
            $param = [
                'user_id' => random_int(1, 5),
                'title' => 'test title'.$i,
                'image' => 'image'.$i.'.jpg',
                'num' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('items')->insert($param);
        }
    }
}

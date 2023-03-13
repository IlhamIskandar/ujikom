<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spps')->insert([
            'year' => '2021/2022',
            'nominal' => 2700000,
        ]);
        DB::table('spps')->insert([
            'year' => '2022/2023',
            'nominal' => 3000000,
        ]);
        DB::table('spps')->insert([
            'year' => '2022/2023',
            'nominal' => 2750000,
        ]);
    }
}

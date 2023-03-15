<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Rekayasa Perangkat Lunak 1',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Rekayasa Perangkat Lunak 2',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Multimedia 1',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Multimedia 2',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Teknik Gambar Mesin 1',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Teknik Gambar Mesin 2',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Mesin 1',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Mesin 2',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Mekatronika 1',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Mekatronika 2',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Elektro 1',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Elektro 2',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Teknik Gambar Mesin 1',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Teknik Gambar Mesin 2',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Tekstil 1',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Tekstil 2',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Teknik Kendaraan Ringan 1',
        ]);
        DB::table('classes')->insert([
            'class_name' => 'XII',
            'competency' => 'Teknik Kendaraan Ringan 2',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'nisn' => '0054890314',
            'nis' => '202110489',
            'student_name' => 'Muhammad Ilham Iskandar',
            'class_id' => 1,
            'address' => 'Bandung, Jawa Barat',
            'phone_number' => '08123123123',
            'spp_id' => 1 ,
            'user_id' => 3 ,

        ]);
        DB::table('students')->insert([
            'nisn' => '0054462930',
            'nis' => '202110476',
            'student_name' => 'Farrel Rafiardi Kusmana',
            'class_id' => 1,
            'address' => 'Bandung, Jawa Barat',
            'phone_number' => '+62 832-132-1321',
            'spp_id' => 2 ,
            'user_id' => 4 ,
        ]);
    }
}

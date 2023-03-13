<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('password'),
            'name' => 'Ilham Iskandar',
            'role' => 'admin',
            'email' => 'email@admin.com',
        ]);

        DB::table('users')->insert([
        	'username' => 'staff',
            'password' => Hash::make('password'),
            'name' => 'Muhammad Iskandar',
            'role' => 'staff',
            'email' => 'email@staff.com',
        ]);

        DB::table('users')->insert([
            'username' => '202110489',
            'password' => Hash::make('0054890314'),
            'name' => 'Muhammad Ilham Iskandar',
            'role' => 'siswa',
            'email' => 'muhammadilhamiskandar1@email.com',
        ]);
        DB::table('users')->insert([
            'username' => '202110476',
            'password' => Hash::make('0054462930'),
            'name' => 'Farrel Rafiardi Kusmana',
            'role' => 'siswa',
            'email' => 'farrelrafiardi@email.com',
        ]);
    }
}

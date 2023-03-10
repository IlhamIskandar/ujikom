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
            'name' => 'Akun admin',
            'role' => 'admin',
            'email' => 'email@admin.com',
        ]);

        DB::table('users')->insert([
        	'username' => 'staff',
            'password' => Hash::make('password'),
            'name' => 'Akun Staff',
            'role' => 'staff',
            'email' => 'email@staff.com',
        ]);

        DB::table('users')->insert([
            'username' => '321321',
            'password' => Hash::make('123123'),
            'name' => 'Muhammad Ilham Iskandar',
            'role' => 'siswa',
            'email' => 'email@siswa.com',
        ]);

    }
}

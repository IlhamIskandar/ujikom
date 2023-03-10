<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SppPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spp_payments')->insert([
        	'user_id' => 2,
        	'nisn' => 123123,
        	'payment_date' => Carbon::now('GMT+7'),//'2023-03-09 00:00:00'
        	'spp_id' => 1,
        	'pay_amount' => 200000,
        	'code' => Str::random(12),

        ]);
    }
}

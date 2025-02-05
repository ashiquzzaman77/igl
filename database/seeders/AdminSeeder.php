<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Md Ashiquzzaman',
            'email' => 'ashiquzzaman.rajib.cse@gmail.com',
            'phone' => '01728499226',
            'password' => Hash::make('password'),
        ]);
    }
}

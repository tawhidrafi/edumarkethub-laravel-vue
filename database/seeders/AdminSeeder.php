<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'name' => 'Super Admin',
                'phone' => '01700000011',
                'username' => 'admin',
                'password' => Hash::make('12345678'),
                'status' => 'active',
                'created_at' => now(),
            ],
            [
                'name' => 'Assistant Admin',
                'phone' => '01800000011',
                'username' => 'assistant',
                'password' => Hash::make('87654321'),
                'status' => 'active',
                'created_at' => now(),
            ],
        ]);
    }
}

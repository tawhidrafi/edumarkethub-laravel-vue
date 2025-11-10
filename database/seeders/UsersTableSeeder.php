<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'password' => Hash::make('12345678'),
                'profile_image' => null,
                'bio' => 'Loves online learning and tech courses.',
                'bkash_num' => '01710000001',
                'status' => 'active',
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob@example.com',
                'password' => Hash::make('12345678'),
                'profile_image' => null,
                'bio' => 'Aspiring developer, interested in web apps.',
                'bkash_num' => '01710000002',
                'status' => 'active',
            ],
        ]);
    }
}

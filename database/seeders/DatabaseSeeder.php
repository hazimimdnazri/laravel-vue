<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            'name' => 'ADMIN',
            'email' => 'admin@mail.com',
            'date_verified' => date('Y-m-d H:i:s'),
            'date_password' => date('Y-m-d H:i:s'),
        ];

        DB::table('users')->insert($users);
    }
}

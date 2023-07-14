<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            [
                'username' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'department_id' => 1,
                'status_id' => 1,
            ],
            [
                'username' => 'usertest',
                'name' => 'Test',
                'email' => 'usertest@gmail.com',
                'password' => Hash::make('password'),
                'department_id' => 1,
                'status_id' => 1,
            ],
        ]);
    }
}

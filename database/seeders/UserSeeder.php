<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'full_name' => "Admin",
            'email' => 'admin@admin.com',
            'phone' => '1234567890',
            'address' => 'test',
            'password' => bcrypt('password'),
            'created_on' => time()
        ]);
    }
}

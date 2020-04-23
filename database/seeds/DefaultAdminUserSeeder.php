<?php

use Illuminate\Database\Seeder;

class DefaultAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$9VSHuFu3A5yNjLU5qb/TouGE.SYMuKcQ1b4hqgff.lsVHbsD3nxk6',
        ]);
    }
}

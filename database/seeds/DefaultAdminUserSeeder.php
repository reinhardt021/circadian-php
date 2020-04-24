<?php

use Illuminate\Database\Seeder;

class DefaultAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$9VSHuFu3A5yNjLU5qb/TouGE.SYMuKcQ1b4hqgff.lsVHbsD3nxk6',
        ]);
    }
}

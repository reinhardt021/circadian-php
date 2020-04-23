<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call([
             DefaultAdminUserSeeder::class,
             FlowSeeder::class,
             TaskSeeder::class,
//             UsersTableSeeder::class,
         ]);
    }
}

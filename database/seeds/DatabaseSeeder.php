<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             DefaultAdminUserSeeder::class,
             FlowSeeder::class,
             TaskSeeder::class,
//             UsersTableSeeder::class,
         ]);
    }
}

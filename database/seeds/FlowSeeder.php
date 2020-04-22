<?php

use Illuminate\Database\Seeder;

class FlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flows')->insert([
            ['title' => 'pomodoro'],
            ['title' => 'stretch'],
        ]);
    }
}

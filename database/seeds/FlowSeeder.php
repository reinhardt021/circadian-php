<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('flows')->insert([
            [
                'title' => 'pomodoro',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'stretch',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'title' => 'warm up',
                'hours' => 0,
                'minutes' => 0,
                'seconds' => 15,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'WORK',
                'hours' => 0,
                'minutes' => 25,
                'seconds' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'break',
                'hours' => 0,
                'minutes' => 15,
                'seconds' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'title' => 'warm up',
                'hours' => 0,
                'minutes' => 0,
                'seconds' => 15,
            ],
            [
                'title' => 'WORK',
                'hours' => 0,
                'minutes' => 25,
                'seconds' => 0,
            ],
            [
                'title' => 'break',
                'hours' => 0,
                'minutes' => 15,
                'seconds' => 0,
            ],
        ]);
    }
}

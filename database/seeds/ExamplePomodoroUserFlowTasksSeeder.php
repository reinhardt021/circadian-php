<?php

use App\Flow;
use App\Task;
use App\TaskOrder;
use App\User;
use Illuminate\Database\Seeder;

class ExamplePomodoroUserFlowTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var User $user */
        $user = \factory(User::class)->create([
            'name' => 'user@gmail.com',
            'email' => 'user@gmail.com',
            'password' => '$2y$10$59nJ/xtv6SYJungYXgocJObaGMkJn.MtOhEvlVr2iNhBp8wCH3yF.',
        ]);

        /** @var Flow $flow */
        $flow = \factory(Flow::class)->create([
            'title' => 'pomodoro',
        ]);

        $user->flows()->attach($flow->id);

        $newTasks = [
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
        ];

        /** @var Task[] $tasks */
        $tasks = \collect($newTasks)->map(function ($newTask, $key) use ($flow) {
            /** @var Task $task */
            $task = \factory(Task::class)->create($newTask);
            $taskOrder = \factory(TaskOrder::class)->create(['position' => ($key + 1)]);
            $task->taskOrder()->save($taskOrder);
            $flow->taskOrders()->save($taskOrder);
            $flow->tasks()->save($task);

            return $task;
        })->toArray();
    }
}

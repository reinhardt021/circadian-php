<?php

namespace App\Services;

use App\Commands\TaskDestroyCommand;
use App\Commands\TaskStoreCommand;
use App\Commands\TaskUpdateCommand;
use App\Flow;
use App\Queries\TaskIndexQuery;
use App\Queries\TaskShowQuery;
use App\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskResourceService
{
    /**
     * Get a list of the Tasks for a Flow
     *
     * @return Task[]|Collection
     */
    public function getTasks(TaskIndexQuery $query): Collection
    {
        $tasks = Task::where('flow_id', $query->flowId)->get();

        return $tasks;
    }

    /**
     * Create a new Task
     */
    public function postTask(TaskStoreCommand $command): Task
    {
        /** @var Flow $flow */
        $flow = Flow::find($command->flowId);

        $task = new Task();
        $task->title = $command->title;
        $task->hours = $command->hours;
        $task->minutes = $command->minutes;
        $task->seconds = $command->seconds;
        $task->save();
        $flow->tasks()->save($task);

        return $task;
    }

    /**
     * Get the single Task
     */
    public function getTask(TaskShowQuery $query): Task
    {
        $task = Task::where('id', $query->taskId)->where('flow_id', $query->flowId)->first();

        return $task;
    }

    /**
     * Update the given Task
     */
    public function updateTask(TaskUpdateCommand $command): Task
    {
        $task = Task::where('id', $command->taskId)
            ->where('flow_id', $command->flowId)
            ->first();
        $task->title = $command->title ?: $task->title;
        $task->hours = $command->hours ?: $task->hours;
        $task->minutes = $command->minutes ?: $task->minutes;
        $task->seconds = $command->seconds ?: $task->seconds;
        $task->save();

        return $task;
    }

    /**
     * Delete a Task
     *
     * @throws \Exception
     */
    public function deleteTask(TaskDestroyCommand $command): ?bool
    {
        $task = Task::where('id', $command->taskId)
            ->where('flow_id', $command->flowId)
            ->first();

        return $task->delete();
    }
}

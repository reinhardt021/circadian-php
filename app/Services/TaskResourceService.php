<?php

namespace App\Services;

use App\Commands\TaskDestroyCommand;
use App\Commands\TaskStoreCommand;
use App\Commands\TaskUpdateCommand;
use App\Queries\TaskIndexQuery;
use App\Queries\TaskShowQuery;
use App\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskResourceService
{
    /**
     * Get a list of the Tasks for a Flow
     *
     * @param TaskIndexQuery $query
     *
     * @return Task[]|Collection
     */
    public function getTasks(TaskIndexQuery $query)
    {
        // todo: update to use the flowId to narrow down tasks returned
        $tasks = Task::all();

        return $tasks;
    }

    /**
     * Create a new Task
     *
     * @param TaskStoreCommand $command
     *
     * @return Task
     */
    public function postTask(TaskStoreCommand $command)
    {
        // todo: update to use the flowId to narrow down Flow to add tasks to
        $task = new Task();
        $task->title = $command->title;
        $task->hours = $command->hours;
        $task->minutes = $command->minutes;
        $task->seconds = $command->seconds;
        $task->save();

        return $task;
    }

    /**
     * Get the single Task
     *
     * @param TaskShowQuery $query
     *
     * @return Task
     */
    public function getTask(TaskShowQuery $query)
    {
        // todo: update to use the flowId to narrow down Flow to add tasks to
        $task = Task::find($query->taskId);

        return $task;
    }

    /**
     * Update the given Task
     *
     * @param TaskUpdateCommand $command
     *
     * @return Task
     */
    public function updateTask(TaskUpdateCommand $command)
    {
        // todo: update to use the flowId to narrow down Flow to add tasks to
        $task = Task::find($command->taskId);
        $task->title = $command->title ?: $task->title;
        $task->hours = $command->hours ?: $task->hours;
        $task->minutes = $command->minutes ?: $task->minutes;
        $task->seconds = $command->seconds ?: $task->seconds;

        return $task;
    }

    /**
     * Delete a Task
     *
     * @param TaskDestroyCommand $command
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deleteTask(TaskDestroyCommand $command)
    {
        // todo: update to use the flowId to narrow down task returned
        $task = Task::find($command->taskId);

        return $task->delete();
    }
}

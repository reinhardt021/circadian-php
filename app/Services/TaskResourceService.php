<?php

namespace App\Services;

use App\Commands\TaskDestroyCommand;
use App\Commands\TaskStoreCommand;
use App\Queries\TaskIndexQuery;
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
        /** @var Task $task */
        $task = Task::find($command->taskId);

        return $task->delete();
    }
}

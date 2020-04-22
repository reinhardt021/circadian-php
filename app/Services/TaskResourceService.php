<?php

namespace App\Services;

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
}

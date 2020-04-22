<?php

namespace App\Queries;

use Illuminate\Http\Request;

class TaskShowQuery
{
    public int $flowId;
    public int $taskId;

    public static function buildFromRequest(Request $request)
    {
        $query = new self();
        $query->flowId = $request->flow;
        $query->taskId = $request->task;

        return $query;
    }
}

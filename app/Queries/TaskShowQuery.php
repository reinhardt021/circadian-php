<?php

namespace App\Queries;

use Illuminate\Http\Request;

class TaskShowQuery
{
    public int $flowId;
    public int $taskId;

    /**
     * Build Query from Request
     */
    public static function buildFromRequest(Request $request): self
    {
        $query = new self();
        $query->flowId = $request->flow;
        $query->taskId = $request->task;

        return $query;
    }
}

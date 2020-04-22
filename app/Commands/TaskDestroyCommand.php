<?php

namespace App\Commands;

use Illuminate\Http\Request;

class TaskDestroyCommand
{
    public int $flowId;
    public int $taskId;

    public function __construct(Request $request)
    {
        $this->flowId = $request->flow;
        $this->taskId = $request->task;
    }
}

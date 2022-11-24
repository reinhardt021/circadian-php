<?php

namespace App\Commands;

use Illuminate\Http\Request;

class TaskDestroyCommand
{
    public int $flowId;
    public int $taskId;

    /**
     * Create Command from Request
     */
    public static function buildFromRequest(Request $request): self
    {
        $command = new self();
        $command->flowId = $request->flow;
        $command->taskId = $request->task;

        return $command;
    }
}

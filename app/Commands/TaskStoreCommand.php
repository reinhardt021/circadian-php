<?php

namespace App\Commands;

use Illuminate\Http\Request;

class TaskStoreCommand
{
    public int $flowId;
    public string $title;
    public int $hours;
    public int $minutes;
    public int $seconds;

    /**
     * Build Command from Request
     */
    public static function buildFromRequest(Request $request): self
    {
        $command = new self();
        $command->flowId = $request->flow;
        $command->title = $request->input('title');
        $command->hours = $request->input('hours');
        $command->minutes = $request->input('minutes');
        $command->seconds = $request->input('seconds');

        return $command;
    }
}

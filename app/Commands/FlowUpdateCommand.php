<?php

namespace App\Commands;

use Illuminate\Http\Request;

class FlowUpdateCommand
{
    public int $id;
    public string $title;

    /**
     * Create Command from Request
     */
    public static function buildFromRequest(Request $request): self
    {
        $command = new self();
        $command->id = $request->flow;
        $command->title = $request->input('title');

        return $command;
    }
}

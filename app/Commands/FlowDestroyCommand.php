<?php

namespace App\Commands;

use Illuminate\Http\Request;

class FlowDestroyCommand
{
    public int $id;

    /**
     * Create Command from Request
     */
    public static function buildFromRequest(Request $request): self
    {
        $command = new self();
        $command->id = $request->flow;

        return $command;
    }
}

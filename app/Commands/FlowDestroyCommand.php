<?php

namespace App\Commands;

use Illuminate\Http\Request;

class FlowDestroyCommand
{
    public int $id;

    /**
     * Create Command from Request
     *
     * @param Request $request
     *
     * @return self
     */
    public static function buildFromRequest(Request $request)
    {
        $command = new self();
        $command->id = $request->flow;

        return $command;
    }
}

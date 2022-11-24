<?php

namespace App\Commands;

use Illuminate\Http\Request;

class FlowStoreCommand
{
    public string $title;

    /**
     * Create Command from Request
     */
    public static function buildFromRequest(Request $request): self
    {
        $command = new self();
        $command->title = $request->input('title');

        return $command;
    }
}

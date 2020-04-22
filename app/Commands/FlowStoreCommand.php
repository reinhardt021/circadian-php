<?php

namespace App\Commands;

use Illuminate\Http\Request;

class FlowStoreCommand
{
    public string $title;

    public static function buildFromRequest(Request $request)
    {
        $command = new self();
        $command->title = $request->input('title');

        return $command;
    }
}

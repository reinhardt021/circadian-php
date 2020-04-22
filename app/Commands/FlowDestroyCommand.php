<?php

namespace App\Commands;

use Illuminate\Http\Request;

class FlowDestroyCommand
{
    public int $id;

    public function __construct(Request $request)
    {
        $this->id = $request->flow;
    }
}

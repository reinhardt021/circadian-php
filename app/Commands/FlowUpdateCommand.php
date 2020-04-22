<?php

namespace App\Commands;

use Illuminate\Http\Request;

class FlowUpdateCommand
{
    public int $id;
    public string $title;

    public function __construct(Request $request)
    {
        $this->id = $request->flow;
        $this->title = $request->input('title');
    }
}

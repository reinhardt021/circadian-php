<?php

namespace App\Commands;

use Illuminate\Http\Request;

class FlowStoreCommand
{
    public string $title;

    public function __construct(Request $request)
    {
        $this->title = $request->input('title');
    }
}

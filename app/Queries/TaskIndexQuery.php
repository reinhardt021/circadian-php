<?php

namespace App\Queries;

use Illuminate\Http\Request;

class TaskIndexQuery
{
    public int $flowId;

    public function __construct(Request $request)
    {
        $this->flowId = $request->flow;
    }
}

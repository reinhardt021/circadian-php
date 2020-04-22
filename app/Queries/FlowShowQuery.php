<?php

namespace App\Queries;

use Illuminate\Http\Request;

class FlowShowQuery
{
    public int $id;

    public function __construct(Request $request)
    {
        $this->id = $request->flow;
    }
}

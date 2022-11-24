<?php

namespace App\Queries;

use Illuminate\Http\Request;

class TaskIndexQuery
{
    public int $flowId;

    /**
     * Create a Query object from a Request object
     */
    public static function buildFromRequest(Request $request): self
    {
        $query = new self();
        $query->flowId = $request->flow;

        return $query;
    }
}

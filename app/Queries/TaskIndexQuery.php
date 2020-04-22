<?php

namespace App\Queries;

use Illuminate\Http\Request;

class TaskIndexQuery
{
    public int $flowId;

    /**
     * Create a Query object from a Request object
     *
     * @param Request $request
     *
     * @return self
     */
    public static function buildFromRequest(Request $request)
    {
        $query = new self();
        $query->flowId = $request->flow;

        return $query;
    }
}

<?php

namespace App\Queries;

use Illuminate\Http\Request;

class FlowShowQuery
{
    public int $id;

    /**
     * Create Query from Request
     *
     * @param Request $request
     *
     * @return self
     */
    public static function buildFromRequest(Request $request)
    {
        $query = new self();
        $query->id = $request->flow;

        return $query;
    }
}

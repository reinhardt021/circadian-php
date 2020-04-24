<?php

namespace App\Queries;

use Illuminate\Http\Request;

class FlowShowQuery
{
    public int $id;

    /**
     * Create Query from Request
     */
    public static function buildFromRequest(Request $request): self
    {
        $query = new self();
        $query->id = $request->flow;

        return $query;
    }
}

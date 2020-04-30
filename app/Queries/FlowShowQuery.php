<?php

namespace App\Queries;

use Illuminate\Http\Request;

class FlowShowQuery
{
    public int $id;
    public array $include;

    /**
     * Create Query from Request
     */
    public static function buildFromRequest(Request $request): self
    {
        $query = new self();
        $query->id = $request->flow;
        $include = $request->input('include');
        $query->include = $include ? \explode(',', $include) : [];

        return $query;
    }
}

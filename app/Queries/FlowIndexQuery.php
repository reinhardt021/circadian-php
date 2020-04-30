<?php

namespace App\Queries;

use Illuminate\Http\Request;

class FlowIndexQuery
{
    public array $include;

    public static function buildFromRequest(Request $request): self
    {
        $query = new self();
        // todo: use the request to get the User in the session >> do in Query DTO
        $include = $request->input('include');
        $query->include = $include ? \explode(',', $include) : [];

        return $query;
    }
}

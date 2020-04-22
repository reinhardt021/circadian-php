<?php

namespace App\Services;

use App\Flow;
use Illuminate\Database\Eloquent\Collection;

class FlowResourceService
{
    /**
     * @return Flow[]|Collection
     */
    public function getFlows()
    {
        $flows = Flow::all();

        return $flows;
    }
}

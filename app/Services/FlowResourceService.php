<?php

namespace App\Services;

use App\Commands\FlowStoreCommand;
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

    /**
     * @param FlowStoreCommand $command
     *
     * @return Flow
     */
    public function postFlow(FlowStoreCommand $command)
    {
        $flow = new Flow();
        $flow->title = $command->title;
        $flow->save();

        return $flow;
    }
}

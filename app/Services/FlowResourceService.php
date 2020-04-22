<?php

namespace App\Services;

use App\Commands\FlowDestroyCommand;
use App\Commands\FlowStoreCommand;
use App\Commands\FlowUpdateCommand;
use App\Flow;
use App\Queries\FlowShowQuery;
use Illuminate\Database\Eloquent\Collection;

class FlowResourceService
{
    /**
     * Get a list of all active Flows
     *
     * @return Flow[]|Collection
     */
    public function getFlows()
    {
        $flows = Flow::all();

        return $flows;
    }

    /**
     * Creating a new Flow object
     *
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

    /**
     * Grabbing a single Flow object
     *
     * @param FlowShowQuery $query
     *
     * @return Flow
     */
    public function getFlow(FlowShowQuery $query)
    {
        $flow = Flow::find($query->id);

        return $flow;
    }

    /**
     * Update a Flow
     *
     * @param FlowUpdateCommand $command
     *
     * @return Flow
     */
    public function updateFlow(FlowUpdateCommand $command)
    {
        $flow = Flow::find($command->id);
        $flow->title = $command->title;
        $flow->save();

        return $flow;
    }

    /**
     * Delete a Flow
     *
     * @param FlowDestroyCommand $command
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deleteFlow(FlowDestroyCommand $command)
    {
        /** @var Flow $flow */
        $flow = Flow::find($command->id);

        return $flow->delete();
    }
}

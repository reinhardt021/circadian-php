<?php

namespace App\Services;

use App\Commands\FlowDestroyCommand;
use App\Commands\FlowStoreCommand;
use App\Commands\FlowUpdateCommand;
use App\Flow;
use App\Queries\FlowIndexQuery;
use App\Queries\FlowShowQuery;
use Illuminate\Database\Eloquent\Collection;

class FlowResourceService
{
    /**
     * Get a list of all active Flows
     *
     * @return Flow[]|Collection
     */
    public function getFlows(FlowIndexQuery $query): Collection
    {
        $flows = Flow::all();
        if (\count($query->include) > 0) {
            $flows->load($query->include);
        }

        return $flows;
    }

    /**
     * Creating a new Flow object
     */
    public function postFlow(FlowStoreCommand $command): Flow
    {
        $flow = new Flow();
        $flow->title = $command->title;
        $flow->save();

        return $flow;
    }

    /**
     * Grabbing a single Flow object
     */
    public function getFlow(FlowShowQuery $query): Flow
    {
        // todo: consider Repository pattern for better testability
        // if Repo pattern used then can combine this with getFlows() just diff Criteria passed
        /** @var Flow $flow */
        $flow = Flow::find($query->id);
        if (\count($query->include) > 0) {
            $flow->load($query->include);
        }

        return $flow;
    }

    /**
     * Update a Flow
     */
    public function updateFlow(FlowUpdateCommand $command): Flow
    {
        $flow = Flow::find($command->id);
        $flow->title = $command->title;
        $flow->save();

        return $flow;
    }

    /**
     * Delete a Flow
     *
     * @throws \Exception
     */
    public function deleteFlow(FlowDestroyCommand $command): ?bool
    {
        /** @var Flow $flow */
        $flow = Flow::find($command->id);

        return $flow->delete();
    }
}

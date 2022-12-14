<?php

namespace App\Http\Controllers\API;

use App\Commands\FlowDestroyCommand;
use App\Commands\FlowStoreCommand;
use App\Commands\FlowUpdateCommand;
use App\Http\Resources\Flow as FlowResource;
use App\Queries\FlowIndexQuery;
use App\Queries\FlowShowQuery;
use App\Http\Controllers\Controller;
use App\Services\FlowResourceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FlowController extends Controller
{
    private FlowResourceService $service;

    public function __construct(FlowResourceService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = FlowIndexQuery::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Flow index route',
                'data' => FlowResource::collection($this->service->getFlows($query)),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $command = FlowStoreCommand::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Flow store route',
                'data' => new FlowResource($this->service->postFlow($command)),
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request): JsonResponse
    {
        $query = FlowShowQuery::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Flow show route',
                'data' => new FlowResource($this->service->getFlow($query)),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): JsonResponse
    {
        $command = FlowUpdateCommand::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Flow update route',
                'data' => new FlowResource($this->service->updateFlow($command)),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws \Exception
     */
    public function destroy(Request $request): JsonResponse
    {
        $this->service->deleteFlow(FlowDestroyCommand::buildFromRequest($request));

        return \response()->json('', Response::HTTP_NO_CONTENT);
    }
}

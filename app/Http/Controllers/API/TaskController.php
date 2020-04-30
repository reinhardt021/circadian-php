<?php

namespace App\Http\Controllers\API;

use App\Commands\TaskDestroyCommand;
use App\Commands\TaskStoreCommand;
use App\Commands\TaskUpdateCommand;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task as TaskResource;
use App\Queries\TaskIndexQuery;
use App\Queries\TaskShowQuery;
use App\Services\TaskResourceService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    private TaskResourceService $service;

    public function __construct(TaskResourceService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = TaskIndexQuery::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Task index route',
                'data' => TaskResource::collection($this->service->getTasks($query)),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $command = TaskStoreCommand::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Task store route',
                'data' => new TaskResource($this->service->postTask($command)),
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request): JsonResponse
    {
        $query = TaskShowQuery::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Task show route',
                'data' => new TaskResource($this->service->getTask($query)),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): JsonResponse
    {
        $command = TaskUpdateCommand::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Task update route',
                'data' => new TaskResource($this->service->updateTask($command)),
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
        $this->service->deleteTask(TaskDestroyCommand::buildFromRequest($request));

        return \response()->json('', Response::HTTP_NO_CONTENT);
    }
}

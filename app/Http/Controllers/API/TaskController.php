<?php

namespace App\Http\Controllers\API;

use App\Commands\TaskDestroyCommand;
use App\Commands\TaskStoreCommand;
use App\Commands\TaskUpdateCommand;
use App\Http\Controllers\Controller;
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
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $query = TaskIndexQuery::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Task entities index',
                'data' => $this->service->getTasks($query),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $command = TaskStoreCommand::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Task has been created',
                'data' => $this->service->postTask($command),
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function show(Request $request)
    {
        $query = TaskShowQuery::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Task has been found',
                'data' => $this->service->getTask($query),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $command = TaskUpdateCommand::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Task has been updated',
                'data' => $this->service->updateTask($command),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        $this->service->deleteTask(TaskDestroyCommand::buildFromRequest($request));

        return \response()->json('', Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Commands\TaskDestroyCommand;
use App\Commands\TaskStoreCommand;
use App\Http\Controllers\Controller;
use App\Queries\TaskIndexQuery;
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
     * @param TaskIndexQuery $query
     *
     * @return JsonResponse
     */
    public function index(TaskIndexQuery $query)
    {
        return \response()->json(
            [
                'message' => 'Task index route',
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
                'message' => 'Task store route',
                'data' => $this->service->postTask($command),
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        return \response()->json([
            'data' => 'task show',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        return \response()->json([
            'data' => 'task update',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TaskDestroyCommand $command
     *
     * @return JsonResponse
     */
    public function destroy(TaskDestroyCommand $command)
    {
        $this->service->deleteTask($command);

        return \response()->json('', Response::HTTP_NO_CONTENT);
    }
}

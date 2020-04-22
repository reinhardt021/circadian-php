<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Queries\TaskIndexQuery;
use App\Services\TaskResourceService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return Response
     */
    public function index(TaskIndexQuery $query)
    {
        return response()->json([
            'message' => 'Task index route',
            'data' => $this->service->getTasks($query),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $title = $request->input('title');

        return response()->json([
            'data' => "task store route with new title $title",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return response()->json([
            'data' => 'task show',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            'data' => 'task update',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return response()->json([
            'data' => 'task destroy',
        ]);
    }
}

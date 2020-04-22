<?php

namespace App\Http\Controllers\API;

use App\Commands\FlowDestroyCommand;
use App\Commands\FlowStoreCommand;
use App\Commands\FlowUpdateCommand;
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
     *
     * @return JsonResponse
     */
    public function index()
    {
        // todo: use the request to get the User in the session >> do in Query DTO
        // todo: use fractal / transformer
        return \response()->json(
            [
                'message' => 'Flow entities index',
                'data' => $this->service->getFlows(),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FlowStoreCommand $command
     *
     * @return JsonResponse
     */
    public function store(FlowStoreCommand $command)
    {
        return \response()->json(
            [
                'message' => 'Flow has been created',
                'data' => $this->service->postFlow($command),
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  FlowShowQuery $query
     *
     * @return JsonResponse
     */
    public function show(FlowShowQuery $query)
    {
        return \response()->json(
            [
                'message' => 'Flow has been found',
                'data' => $this->service->getFlow($query),
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
        $command = FlowUpdateCommand::buildFromRequest($request);

        return \response()->json(
            [
                'message' => 'Flow has been updated',
                'data' => $this->service->updateFlow($command),
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  FlowDestroyCommand $command
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(FlowDestroyCommand $command)
    {
        $this->service->deleteFlow($command);

        return \response()->json('', Response::HTTP_NO_CONTENT);
    }
}

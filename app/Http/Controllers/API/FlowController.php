<?php

namespace App\Http\Controllers\API;

use App\Commands\FlowDestroyCommand;
use App\Commands\FlowStoreCommand;
use App\Commands\FlowUpdateCommand;
use App\Flow;
use App\Queries\FlowShowQuery;
use App\Http\Controllers\Controller;
use App\Services\FlowResourceService;
use Illuminate\Http\JsonResponse;
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
        $data = $this->service->getFlows();

        // todo: use fractal / transformer
        return \response()->json(
            [
                'message' => 'Flow entities index',
                'data' => $data,
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
        $data = $this->service->postFlow($command);

        return \response()->json(
            [
                'message' => 'Flow has been created',
                'data' => $data,
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
        /** @var Flow $data */
        $data = Flow::find($query->id);

        return \response()->json(
            [
                'message' => 'Flow has been found',
                'data' => $data,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FlowUpdateCommand $command
     *
     * @return JsonResponse
     */
    public function update(FlowUpdateCommand $command)
    {
        /** @var Flow $data */
        $data = Flow::find($command->id);
        $data->title = $command->title;
        $data->save();

        return \response()->json(
            [
                'message' => 'Flow has been updated',
                'data' => $data,
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
        /** @var Flow $data */
        $data = Flow::find($command->id);
        $data->delete();

        return \response()->json('', Response::HTTP_NO_CONTENT);
    }
}

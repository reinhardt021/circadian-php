<?php

namespace App\Http\Controllers\API;

use App\Commands\FlowDestroyCommand;
use App\Commands\FlowStoreCommand;
use App\Commands\FlowUpdateCommand;
use App\Flow;
use App\Queries\FlowShowQuery;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        // todo: use the request to get the User in the session >> do in Query dto

        // move to a service that takes the command
        /** @var Flow $data */
        $data = Flow::all();

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
        /** @var Flow $flow */
        $flow = new Flow();
        $flow->title = $command->title;
        $flow->save();

        return \response()->json(
            [
                'message' => 'Flow has been created',
                'data' => $flow,
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

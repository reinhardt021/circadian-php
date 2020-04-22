<?php

namespace App\Http\Controllers\API;

use App\Flow;
use Illuminate\Http\Request;
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
        // todo: move to query object
        // todo: use the request to get the User in the session

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
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $title = $request->input('title');

        /** @var Flow $flow */
        $flow = new Flow();
        $flow->title = $title;
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
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        /** @var Flow $data */
        $data = Flow::find($id);

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
     * @param Request $request
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $title = $request->input('title');

        /** @var Flow $data */
        $data = Flow::find($id);
        $data->title = $title;
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
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Flow $data */
        $data = Flow::find($id);
        $data->delete();

        return \response()->json('', Response::HTTP_NO_CONTENT);
    }
}

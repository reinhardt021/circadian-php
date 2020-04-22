<?php

namespace App\Http\Controllers\API;

use App\Flow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class FlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        //NOTE that this API works
        // todo: move to query object
        // todo: use the request to get the User in the session

        // move to a service that takes the command
        /** @var Flow $data */
        $data = Flow::all();

        // todo: use fractal / transformer

        return \response()->json([
            'message' => 'Flow index route',
            'data' => $data,
        ]);
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
        //NOTE that this API works
        $title = $request->input('title');

        /** @var Flow $flow */
        $flow = new Flow();
        $flow->title = $title;
        $flow->save();

        return \response()->json([
            'message' => 'Flow store route',
            'data' => $flow,
        ]);
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
        //NOTE that this API works
        /** @var Flow $data */
        $data = Flow::find($id);

        return \response()->json([
            'message' => 'Flow show route',
            'data' => $data,
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
        //NOTE that this API works
        $title = $request->input('title');

        /** @var Flow $data */
        $data = Flow::find($id);
        $data->title = $title;
        $data->save();

        return \response()->json([
            'message' => 'Flow update route',
            'data' => $data,
        ]);
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

        return \response()->json([
            'message' => 'Flow destroy route',
            'data' => $data,
        ]);
    }
}

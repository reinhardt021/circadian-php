<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlowController extends Controller
{
    public function index(Request $request)
    {
        // todo: use the request to get the User in the session
        return response()->json([
            'data' => 'hit index route',
        ]);
    }

    public function store(Request $request)
    {
        $title = $request->input('title');

        return response()->json([
            'data' => "hit store route with new title $title",
        ]);
    }

    public function show()
    {
        return response()->json([
            'data' => 'hit show route',
        ]);
    }

    public function update()
    {
        return response()->json([
            'data' => 'hit update route',
        ]);
    }

    public function destroy()
    {
        return response()->json([
            'data' => 'hit destroy route',
        ]);
    }
}

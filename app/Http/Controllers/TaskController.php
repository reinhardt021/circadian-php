<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'data' => 'task index',
        ]);
    }

    public function store(Request $request)
    {
        $title = $request->input('title');

        return response()->json([
            'data' => "task store route with new title $title",
        ]);
    }

    public function show()
    {
        return response()->json([
            'data' => 'task show',
        ]);
    }

    public function update()
    {
        return response()->json([
            'data' => 'task update',
        ]);
    }

    public function destroy()
    {
        return response()->json([
            'data' => 'task destroy',
        ]);
    }
}

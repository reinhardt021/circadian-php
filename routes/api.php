<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// todo: need to scaffold th auth at least today

Route::prefix('flows')->group(function () {
    // GET/POST api/flows/
    // GET/PUT/DELETE api/flows/:id/
    Route::resource('', 'FlowController')->only([
        'index',
        'store',
        'show',
        'update',
        'destroy',
    ]);

    // GET/POST api/flows/:id/tasks/
    // GET/PUT/DELETE api/flows/:id/tasks/:taskId
});

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

// need to scaffold th auth at least today
// maybe run migrations

// base_path('routes/api.php') not sure if separate files needed
// can just all of them here until it grows too big

// TODO

Route::resource('flows', 'FlowController')->only([
    'index',
    'store',
    'show',
    'update',
    'destroy',
]);
//Route::get('/flows', function (Request $request) {
//    return 'Hello APIs!';
//});
// GET/POST api/flows/
// GET/PUT/DELETE api/flows/:id/

// GET/POST api/flows/:id/tasks/
// GET/PUT/DELETE api/flows/:id/tasks/:taskId

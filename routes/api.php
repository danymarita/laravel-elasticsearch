<?php

use Illuminate\Http\Request;
use App\Problems\ProblemRepository;
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
Route::get('/get-problem', function (\App\Problems\ProblemRepository $repository) {
    if (request('q')) {
        $problem = $repository->search(request('q'));
    } else {
        $problem = \App\Problem::all();
    }
    return response()->json($problem);
});
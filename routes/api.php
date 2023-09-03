<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('get_observations_neocp/{name}', "App\Http\Controllers\MpcSearcher@searchMpcNeocp")->name('api.observations.get-neocp');
// Test for packed designations
Route::get('get_observations_packed/{name}', "App\Http\Controllers\MpcSearcher@searchMpcPacked")->name('api.observations.get-packed');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

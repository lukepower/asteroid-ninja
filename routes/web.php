<?php

use Illuminate\Support\Facades\Route;
use App\Models\MpcNeocpObs;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $latest_observations = MpcNeocpObs::take(10)
                ->orderBy('created_at', 'desc')
               ->get();


    return view('welcome')->with('latest_observations', $latest_observations);
});

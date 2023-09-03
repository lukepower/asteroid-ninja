<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\MpcNeocpObs;
use App\Models\ObservatoryCode;
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

Route::get('get_observations/{name}', function ($name) {

    if (strlen($name) < 3) {
        return response("Name must be at least 3 characters long", 400)->header('Content-Type', 'text/plain');
    }
    $observations = \DB::connection('mpc_db')
        ->table('obs_sbn')
        ->where('obs80', 'like', '%' . $name . '%')
        //->orWhere('trkmpc', $name)
        // ->orderBy('created_at', 'asc')
        ->get();


    /*
    $observations = MpcNeocpObs::where('obs80', 'like', '%' . $name . '%')
        ->orWhere('trkmpc', $name)
        ->orderBy('created_at', 'asc')
        ->get();*/
    $ret = "";
    foreach ($observations as $observation) {
        $ret .=  $observation->obs80 . "\n";
    }

    return response($ret, 200)->header('Content-Type', 'text/plain');
});
// Test for packed designations
Route::get('get_observations_packed/{name}', function ($name) {

    if (strlen($name) < 3) {
        return response("Name must be at least 3 characters long", 400)->header('Content-Type', 'text/plain');
    }
    $observations = \DB::connection('mpc_db')
        ->table('obs_sbn')
        ->where('trksub', $name)
        ->orWhere('permid', $name)
        ->orWhere('provid', $name)
        // ->orderBy('created_at', 'asc')
        ->get();


    /*
    $observations = MpcNeocpObs::where('obs80', 'like', '%' . $name . '%')
        ->orWhere('trkmpc', $name)
        ->orderBy('created_at', 'asc')
        ->get();*/
    $ret = "";
    foreach ($observations as $observation) {
        $ret .=  $observation->obs80 . "\n";
    }

    return response($ret, 200)->header('Content-Type', 'text/plain');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

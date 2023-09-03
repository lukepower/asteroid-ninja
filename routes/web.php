<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\MpcNeocpObs;
use App\Models\ObservatoryCode;
use Illuminate\Support\Str;
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

    /**
     * SELECT count(desig) AS ct_desig,
desig
FROM public.neocp_obs
WHERE "created_at" BETWEEN NOW() - INTERVAL '7 DAYS' AND NOW()
GROUP BY desig
     */
    /*$last_neocp_obs = MpcNeocpObs::select('desig', 'created_at')->groupBy('desig')
        ->whereBetween('created_at', [now()->subDays(7), now()])
        ->get();*/

    $last_neocp_obs =   \DB::connection('mpc_db')->select("SELECT count(desig) AS ct_desig,
    desig
    FROM public.neocp_obs
    WHERE \"created_at\" BETWEEN NOW() - INTERVAL '7 DAYS' AND NOW()
    GROUP BY desig");

    return view('welcome')->with('latest_observations', $latest_observations)
        ->with('last_neocp_obs', $last_neocp_obs);
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

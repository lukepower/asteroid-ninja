<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\MpcNeocpObs;
use App\Models\ObservatoryCode;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Cache;
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

    $z28_totals_neocp = Cache::remember('z28_totals_neocp', 600, function () {
        return MpcNeocpObs::where('obs80', 'like', '%Z28%')
            ->whereBetween('created_at', [now()->subDays(7), now()])
            ->count();
    });

    $z28_totals_obs = Cache::remember('z28_totals_obs', 600, function () {
        return \DB::connection('mpc_db')->select("SELECT count(stn) AS ct_stn, stn FROM public.obs_sbn WHERE stn = 'Z28' GROUP BY stn");
    });


    return view('welcome')->with('latest_observations', $latest_observations)
        ->with('last_neocp_obs', $last_neocp_obs)
        ->with('z28_totals_neocp', $z28_totals_neocp)
        ->with('z28_totals_obs', $z28_totals_obs[0]->ct_stn);
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

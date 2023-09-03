<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MpcSearcher extends Controller
{
    //

    public function searchMpcNeocp(Request $request)
    {
        $name = $request->name;
        if (strlen($name) < 3) {
            return response("Name must be at least 3 characters long", 400)->header('Content-Type', 'text/plain');
        }
        $observations = \DB::connection('mpc_db')
            ->table('neocp_obs')
            ->where('desig',  $name)
            //->orWhere('trkmpc', $name)
            // ->orderBy('created_at', 'asc')
            ->get();
        $ret = "";

        foreach ($observations as $observation) {
            $ret .=  $observation->obs80 . "\n";
        }

        return response($ret, 200)->header('Content-Type', 'text/plain');
    }

    public function searchMpcPacked(Request $request)
    {
        $name = $request->name;
        if (strlen($name) < 3) {
            return response("Name must be at least 3 characters long", 400)->header('Content-Type', 'text/plain');
        }
        $ret = "";

        $observations = \DB::connection('mpc_db')
            ->table('obs_sbn')
            ->where('permid', $name)
            ->get();

        if (count($observations) == 0) {
            // Switch to other
            $ret .= "#Try to switch to provid\n";

            $observations = \DB::connection('mpc_db')
                ->table('obs_sbn')
                ->where('provid', $name)
                ->get();
        }
        if (count($observations) == 0) {
            // Switch to other
            $ret .= "#Try to switch to trksub\n";
            $observations = \DB::connection('mpc_db')
                ->table('obs_sbn')
                ->where('trksub', $name)
                ->get();
        }

        /*
        $observations = MpcNeocpObs::where('obs80', 'like', '%' . $name . '%')
            ->orWhere('trkmpc', $name)
            ->orderBy('created_at', 'asc')
            ->get();*/

        foreach ($observations as $observation) {
            $ret .=  $observation->obs80 . "\n";
        }

        return response($ret, 200)->header('Content-Type', 'text/plain');
    }
    /**
     * searchByObscode()
     */
    public function searchByObscode(Request $request)
    {
        $request->validate([
            'obscode' => 'required',
        ]);

        // Check if there is a date range
        $observations_neocp = array();
        $observations = array();
        // Check what type to return
        if (isset($request->type_neocp)) {
            // checked
            $observations_neocp = \DB::connection('mpc_db')
                ->table('neocp_obs')
                ->where('obs80',  'LIKE', '%' . $request->obscode)
                ->orderBy('created_at', 'asc')
                ->get();
            $observations_neocp2 = \DB::connection('mpc_db')
                ->table('neocp_obs_archive')
                ->where('obs80',  'LIKE', '%' . $request->obscode)
                ->orderBy('created_at', 'asc')
                ->get();
            $observations_neocp = $observations_neocp->merge($observations_neocp2);
        }
        if (isset($request->type_normal) || (!isset($request->type_neocp) && !isset($request->type_packed))) {
            // checked
            $observations = \DB::connection('mpc_db')
                ->table('obs_sbn')
                ->where('stn',  $request->obscode)
                ->orderBy('created_at', 'asc')
                ->get();
        }



        $ret = "";

        foreach ($observations as $observation) {
            $ret .=  $observation->obs80 . "\n";
        }
        foreach ($observations_neocp as $observation) {
            $ret .=  $observation->obs80 . "\n";
        }
        return response()->streamDownload(function () use ($ret) {
            echo $ret;
        }, 'observations.txt');
        //return response($ret, 200)->header('Content-Type', 'text/plain');
    }
}

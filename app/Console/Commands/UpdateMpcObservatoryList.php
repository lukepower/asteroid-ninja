<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ObservatoryCode;

class UpdateMpcObservatoryList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'asteroid-ninja:update-mpc-observatory-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches the latest MPC OBSCODE list from the MPC and saves it in the memory server';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->info("Updating MPC Observatory List from server...");

        $url = "https://www.minorplanetcenter.net/iau/lists/ObsCodes.html";
        $data = file_get_contents($url);
        $data = strip_tags($data);
        $data = explode("\n", $data);
        array_shift($data);

        foreach ($data as $row) {
            $code = trim(substr($row, 0, 3));
            if ($code == "" || $code == "Cod") {
                continue;
            }
            $latitude = trim(substr($row, 4, 8));


            $longitude = trim(substr($row, 12, 9));
            $elevation = trim(substr($row, 21, 9));
            $name = trim(substr($row, 30));
            if ($latitude == "") { // some observatories don't have latitude
                $latitude = null;
            }
            if ($longitude == "") { // some observatories don't have longitude
                $longitude = null;
            }
            if ($elevation == "") { // some observatories don't have elevation
                $elevation = null;
            }

            // check if it is in DB
            $observatory_code = ObservatoryCode::where('code', $code)->first();
            if ($observatory_code == null) {
                // Create and insert
                $this->info("Saving $code - $name - $latitude - $longitude - $elevation");
                $observatory_code = new ObservatoryCode();
                $observatory_code->code = $code;
                $observatory_code->name = $name;
                $observatory_code->longitude = $longitude;
                $observatory_code->latitude = $latitude;
                $observatory_code->elevation = $elevation;
                $observatory_code->save();
            }
        }
    }
}

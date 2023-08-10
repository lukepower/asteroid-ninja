<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ObservatoryCode;

class MpcNeocpObs extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mpc_db';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'neocp_obs';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    public function getObservatoryCode()
    {
        return substr(strrchr($this->obs80, " "), 1);
    }

    public function ObservatoryCode()
    {
        $mpc_code = $this->getObservatoryCode();
        $obs_code = ObservatoryCode::where('code', $mpc_code)->first();
        if ($obs_code == null) {
            $obs_code = new ObservatoryCode();
            $obs_code->code = $mpc_code;
        }
        return $obs_code;
    }
}

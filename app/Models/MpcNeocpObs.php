<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('observations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('mpc_obscode', 6);
            $table->string('observer_name', 60);
            $table->string('measurer_name', 60);
            $table->string('tel_data', 80);

            $table->string('perm_id_mpc', 40)->nullable();
            $table->string('perm_id_jpl', 40)->nullable();
            $table->string('perm_id_esa', 40)->nullable();

            $table->string('object_name', 50)->nullable();
            $table->string('prov_id', 30)->nullable();
            $table->string('prov_id_packed', 30)->nullable();
            $table->datetime("obs_time")->nullable();
            $table->string('astrometric_catalog', 20)->nullable();

            $table->decimal("magnitude",6,2)->nullable();
            $table->decimal("magnitude_rms",9,4)->nullable();
            $table->string('photometric_band', 10)->nullable();
            $table->string('photometric_catalog', 20)->nullable();
            $table->decimal('photometric_aperture',8,3)->nullable();
            $table->decimal('log_sn',8,3)->nullable();
            $table->decimal('exposure_time',12,3)->nullable();
            $table->string('notes', 255)->nullable();

            $table->enum('object_type', ['NEO', 'NEOCP', 'PCCP', 'asteroid', 'comet'])->nullable();

            $table->string("submission_line", 255)->nullable();
            $table->datetime("submission_time")->nullable();

            $table->string('ack_line', 255)->nullable();

            $table->string('submission_id', 60)->nullable();
            $table->string('unique_observation_id', 60)->nullable();

            $table->string('mpec_link', 255)->nullable();

            $table->decimal("residual_ra", 12, 3)->nullable();
            $table->decimal("residual_de", 12, 3)->nullable();
            $table->decimal("bias_de", 12, 3)->nullable();
            $table->decimal("apparent_magnitude", 7, 2)->nullable();
            $table->decimal("mag_residual", 12, 3)->nullable();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observations');
    }
};

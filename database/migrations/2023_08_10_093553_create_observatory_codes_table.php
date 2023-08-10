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
        Schema::create('observatory_codes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code', 4)->unique();
            $table->string('name', 255)->nullable();
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();
            $table->float('elevation')->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('timezone', 255)->nullable();
            $table->string('observatory_type', 255)->nullable();
            $table->string('observatory_status', 255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observatory_codes');
    }
};

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
        Schema::create('vehicle_has_options', function (Blueprint $table) {
            $table->uuid('vehicle_id');
            $table->uuid('option_id');

            $table->index('vehicle_id');
            $table->index('option_id');

            $table->primary(['vehicle_id', 'option_id']);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_has_options');
    }
};

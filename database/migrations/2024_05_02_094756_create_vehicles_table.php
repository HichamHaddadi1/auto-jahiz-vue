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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('category_id');
            $table->boolean('in_service');
            $table->uuid('agency_id');
            $table->string('brand');
            $table->string('model');
            $table->string('registration_number');
            $table->string('chassis_number');
            $table->uuid('fuel_id');
            $table->integer('doors_number');
            $table->string('fiscal_power');
            $table->date('circulation_start_date');
            $table->integer('last_mileage');
            $table->decimal('purchase_value', 10, 2);
            $table->string('dealer');
            $table->boolean('is_rented');
            $table->string('image_path')->nullable();
            $table->text('description')->nullable();

            $table->index('category_id');
            $table->index('agency_id');
            $table->index('fuel_id');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

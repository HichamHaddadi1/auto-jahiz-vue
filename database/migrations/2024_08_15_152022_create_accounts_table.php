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
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('currency_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->decimal('tva', 5, 2)->default(0);
            $table->integer('last_bill_number')->default(0);
            $table->integer('last_quote_number')->default(0);
            $table->integer('visite_alert')->default(0);
            $table->integer('insurances_alert')->default(0);
            $table->integer('permissions_alert')->default(0);
            $table->integer('oil_change_alert')->default(0);
            $table->date('expiration_date')->nullable();
            $table->string('social_reason')->nullable();
            $table->integer('max_reservations')->default(0);
            $table->integer('max_clients')->default(0);
            $table->integer('max_vehicles')->default(0);
            $table->string('signature')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('email')->nullable();
            $table->string('prefix_bill')->nullable();
            $table->string('prefix_contract')->nullable();
            $table->string('web_modal')->nullable();
            $table->dateTime('last_access')->nullable();
            $table->uuid('language_id')->nullable();
            $table->uuid('notification_language_id')->nullable();
            $table->text('footers')->nullable();
            $table->integer('files_max_sizes')->nullable();
            $table->string('theme')->nullable()->default('theme-blue');

            $table->index('user_id');
            $table->index('currency_id');
            $table->index('language_id');
            $table->index('notification_language_id');

            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->foreign('notification_language_id')->references('id')->on('languages')->onDelete('cascade');


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};

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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('brand');
            $table->string('model');
            $table->year('year');
            $table->decimal('daily_rate');
            $table->boolean('availability')->default(true);
            $table->string('image_url')->nullable();
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->string('car_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

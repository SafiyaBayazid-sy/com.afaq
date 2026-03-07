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
        Schema::create('projects', function (Blueprint $table) {
          $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->enum('project_status', ['on_hold', 'in_progress', 'completed'])
                  ->default('on_hold');
            $table->enum('project_type', ['renovation', 'construction'])->nullable();
            $table->enum('property_type', ['villa', 'building', 'floor', 'apartment', 'land'])
                  ->nullable();
            $table->string('map_location')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Indexes
            $table->index('project_status');
            $table->index('is_active');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

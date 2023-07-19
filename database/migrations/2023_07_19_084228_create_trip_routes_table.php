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
        Schema::create('trip_routes', function (Blueprint $table) {
            $table->id();
            $table->string('origin');
            $table->string('destination');
            $table->decimal('distance', 8, 2); // Assuming distance is stored in kilometers with 2 decimal places
            $table->time('estimated_travel_time'); // Assuming estimated travel time is stored as a time value
            $table->string('route_code')->unique(); // A unique code to identify the route (e.g., generated based on origin and destination)
            $table->text('description')->nullable(); // A brief description of the route
            $table->string('route_map')->nullable(); // The URL or file path to the route map
            $table->boolean('active')->default(true); // A flag to indicate if the route is currently active or not
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_routes');
    }
};

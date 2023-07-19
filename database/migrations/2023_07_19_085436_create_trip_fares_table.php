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
        Schema::create('trip_fares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_route_id');
            $table->decimal('base_fare', 8, 2);
            $table->decimal('discount', 8, 2)->default(0.00);
            $table->string('discount_type')->nullable();
            $table->decimal('additional_fee', 8, 2)->default(0.00);
            $table->string('additional_fee_type')->nullable();
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('trip_route_id')->references('id')->on('trip_routes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_fares');
    }
};

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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('total_seats');
            $table->string('model')->nullable();
            $table->integer('manufacture_year')->nullable();
            $table->string('registration_number')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_available')->default(true);
            $table->string('image')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->boolean('wifi_available')->default(false);
            $table->boolean('air_conditioned')->default(false);
            $table->boolean('wheelchair_accessible')->default(false);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users'); // Assuming there's a 'users' table for user management
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};

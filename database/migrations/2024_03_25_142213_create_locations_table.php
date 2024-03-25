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
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('location_id');

            $table->string('location_name');
            $table->enum('location_type', ['kraj', 'okres', 'mesto', 'obec']); // Typ lokality (kraj, okres, mesto, obec)
            $table->unsignedBigInteger('location_parent_id')->nullable(); // ID nadradenej lokality
        
            $table->foreign('location_parent_id')->references('location_id')->on('locations');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};

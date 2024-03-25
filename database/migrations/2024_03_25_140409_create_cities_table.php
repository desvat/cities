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
        Schema::create('cities', function (Blueprint $table) {

            $table->bigIncrements('city_id');
  
            $table->string('city_name')->unique();
            $table->string('city_mayor');
            $table->string('city_address');
            $table->text('city_phone')->nullable();
            $table->text('city_fax')->nullable();
            $table->text('city_email')->nullable();
            $table->string('city_web')->nullable();

            $table->timestamps();
            $table->unique('city_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};

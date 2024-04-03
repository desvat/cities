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
  
            $table->enum('city_type', ['kraj', 'okres', 'mesto', 'obec']); 

            $table->string('city_name')->unique();
            $table->string('city_mayor')->nullable();
            $table->string('city_district')->nullable();
            $table->string('city_county')->nullable();
            $table->string('city_region')->nullable();
            $table->string('city_address')->nullable();
            $table->text('city_phone')->nullable();
            $table->text('city_fax')->nullable();
            $table->text('city_email')->nullable();
            $table->string('city_web')->nullable();
            $table->string('city_crest_img')->nullable();

            // $table->unsignedBigInteger('city_parent_id')->nullable();
            // $table->foreign('city_parent_id')->references('city_id')->on('cities');

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

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
        Schema::create('crests', function (Blueprint $table) {

            $table->bigIncrements('crest_id');
            $table->string('crest_img');
            
            $table->unsignedBigInteger('city_id');

            $table->foreign('crest_id')->references('city_id')->on('cities');

            $table->timestamps();
            $table->unique('crest_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crests');
    }
};

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
        Schema::create('object_properties', function (Blueprint $table) {
            $table->unsignedBigInteger('object_entity_id');
            $table->unsignedBigInteger('property_id');
            $table->timestamps();
            $table->json('data')->nullable();
            $table->foreign('object_entity_id')->references('id')->on('object_entities');
            $table->foreign('property_id')->references('id')->on('properties');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('object_properties');
    }
};

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
        Schema::create('object_entities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('object_category_id')->nullable()->nullOnDelete();
            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('location_settlement')->nullable();
            $table->string('location_street')->nullable();
            $table->string('location_house_number')->nullable();
            $table->string('location_building_number')->nullable();
            $table->bigInteger('price')->nullable();
            $table->string('price_currency')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tour3d_url')->nullable();
            $table->foreignUuid('user_id')->nullable()->nullOnDelete();
            $table->timestamp('start_publish_at')->nullable();  
            $table->timestamp('end_publish_at')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('object_entities');
    }
};

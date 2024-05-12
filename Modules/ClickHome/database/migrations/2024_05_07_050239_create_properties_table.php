<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\ClickHome\Enums\PropertyTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->default(PropertyTypeEnum::TEXT->value);
            $table->unsignedBigInteger('property_group_id');
            $table->foreign('property_group_id')->references('id')->on('property_groups')->onDelete('cascade');
            $table->integer('order')->nullable();         
            $table->boolean('is_required')->default(false);         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};

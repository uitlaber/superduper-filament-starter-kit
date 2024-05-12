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
        Schema::create('object_category_property_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('object_category_id');
            $table->unsignedBigInteger('property_group_id');
            $table->foreign('object_category_id')->references('id')->on('object_categories')->onDelete('cascade');            
            $table->foreign('property_group_id')->references('id')->on('property_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('object_category_property_groups');
    }
};

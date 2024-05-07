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
        Schema::create('object_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('object_entity_id')->nullable()->nullOnDelete();
            $table->string('phone');
            $table->string('name');
            $table->string('email')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('object_contacts');
    }
};

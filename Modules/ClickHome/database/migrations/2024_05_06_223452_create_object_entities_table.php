<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\ClickHome\Enums\DealTypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('object_entities', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();            
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('set null');
            $table->string('location')->nullable();
            $table->string('location_settlement')->nullable();
            $table->string('location_street')->nullable();
            $table->string('location_house_number')->nullable();
            $table->string('location_building_number')->nullable();
            $table->decimal('price', 10,2);
            $table->string('price_currency')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('ar_url')->nullable();
            $table->string('tour3d_url')->nullable();
            $table->uuid('user_id');
            $table->enum('deal_type', DealTypeEnum::toArray());
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamp('start_publish_at')->nullable();
            $table->timestamp('end_publish_at')->nullable();
            $table->unsignedBigInteger('object_category_id')->nullable();
            $table->foreign('object_category_id')
                ->references('id')
                ->on('object_categories')
                ->onDelete('set null'); // Set the onDelete action 
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

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
        Schema::create('object_category_deal_types', function (Blueprint $table) {
            $table->unsignedBigInteger('object_category_id');
            $table->unsignedBigInteger('deal_type_id');
            $table->foreign('object_category_id')->references('id')->on('object_categories')->onDelete('cascade');
            $table->foreign('deal_type_id')->references('id')->on('deal_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('object_category_deal_types');
    }
};

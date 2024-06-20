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
        Schema::table('object_entities', function (Blueprint $table) {           
            $table->integer('deal_type_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('object_entities', function (Blueprint $table) {
            $table->dropColumn('deal_type_id');
        });

        Schema::table('object_entities', function (Blueprint $table) {
            $table->enum('deal_type', DealTypeEnum::toArray());
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('db_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('db_item_id');
            $table->integer('avg_one')->nullable();
            $table->integer('avg_stack')->nullable();
            $table->integer('avg_shulker')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('db_prices');
    }
};

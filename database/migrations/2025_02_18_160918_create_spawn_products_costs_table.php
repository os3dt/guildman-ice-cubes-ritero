<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spawn_products_costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('db_item_id');
            $table->integer('one_stack')->nullable()->default(0);
            $table->integer('one_shulker')->nullable()->default(0);
            $table->string('trader');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spawn_products_costs');
    }
};

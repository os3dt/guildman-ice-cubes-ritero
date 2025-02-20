<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('price_ices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('db_item_id');
            $table->string('one');
            $table->string('stack');
            $table->string('shulker');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_ices');
    }
};

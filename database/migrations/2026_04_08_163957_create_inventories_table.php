<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item_name'); // e.g., "Crushed Ice", "Storage Boxes"
            $table->decimal('quantity', 10, 2);
            $table->string('unit'); // e.g., "kg", "pcs"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};

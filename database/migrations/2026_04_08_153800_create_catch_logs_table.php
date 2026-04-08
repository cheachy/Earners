<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('catch_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fisher_profile_id')->constrained()->onDelete('cascade');
            $table->string('species');
            $table->decimal('weight_kg', 8, 2);
            $table->string('quality_grade');
            $table->date('date_caught');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('catch_logs');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('catch_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fisher_profile_id')->constrained()->onDelete('cascade');
            $table->string('species')->nullable();
            
            // Fields for your prototype logic
            $table->decimal('declared_weight', 8, 2)->nullable(); // From SMS
            $table->decimal('weight_kg', 8, 2)->nullable();      // Actual Weight from Scale
            
            $table->string('quality_grade')->nullable(); // Added this back for the seeder
            $table->date('date_caught');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('catch_logs');
    }
};
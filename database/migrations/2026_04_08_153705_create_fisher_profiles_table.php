<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('fisher_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('contact_number');
            $table->string('location_zone');
            $table->string('preferred_payment');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('fisher_profiles');
    }
};
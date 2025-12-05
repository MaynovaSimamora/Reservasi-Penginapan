<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('location')->default('Makassar');
            $table->enum('type', ['standard','deluxe','suite']);
            $table->text('description')->nullable();
            $table->integer('capacity')->default(2);
            $table->decimal('price_per_night',12,2);
            $table->string('thumbnail')->nullable(); // path gambar utama
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('rooms'); }
};
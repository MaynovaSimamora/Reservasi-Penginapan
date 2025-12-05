<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guest_count');
            $table->enum('status',['pending','confirmed','cancelled'])->default('pending');
            $table->decimal('total_price',12,2);
            $table->string('whatsapp_target'); // nomor user
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('reservations'); }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assistance_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa yang mengaju/membuat
        $table->string('title'); // Judul/Nama Penerima Bantuan
        $table->string('category'); // Misal: Sembako, Kesehatan, Pendidikan, Bencana
        $table->string('location'); // Lokasi/Alamat
        $table->string('phone'); // No. HP / WhatsApp
        $table->text('description'); // Detail cerita/kebutuhan
        $table->string('image')->nullable(); // Foto bukti/kondisi (opsional)
        $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending'); // Status persetujuan Admin
         $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistance_requests');
    }
};

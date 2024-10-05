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
        Schema::create('commentbarang', function (Blueprint $table) {
            $table->id();
            $table->text('komentar');
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('barang_id')->constrained('barang_hilangs')->cascadeOnUpdate()->cascadeOnDelete(); // Mengacu ke barang_hilangs
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentbarang');
    }
};

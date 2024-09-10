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
        Schema::create('baranghilang', function (Blueprint $table) {
            $table->id(); // ID untuk barang hilang
            $table->string('nama_barang'); // Nama barang
            $table->string('alamat_barang');
            $table->text('deskripsi_barang'); // Deskripsi barang
            $table->string('gambar_barang')->nullable(); // Gambar barang, bisa nullable jika gambar tidak wajib
            $table->boolean('status')->default(0); // Status barang sebagai boolean (0 = hilang, 1 = ditemukan)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key mengarah ke tabel 'users'
            $table->timestamps(); // Tanggal create dan update
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baranghilang');
    }
};

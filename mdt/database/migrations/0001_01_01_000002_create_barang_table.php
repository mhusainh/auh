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
        Schema::create('barang_hilangs', function (Blueprint $table) {
            $table->id(); // ID untuk barang hilang
            $table->string('nama_barang'); // Nama barang
            $table->string('alamat_barang');
            $table->text('deskripsi_barang'); // Deskripsi barang
            $table->date('tanggal_hilang');
            $table->string('gambar_barang1');
            $table->string('gambar_barang2')->nullable();
            $table->string('gambar_barang3')->nullable();
            $table->string('gambar_barang4')->nullable();
            $table->string('gambar_barang5')->nullable(); // Gambar barang, bisa nullable jika gambar tidak wajib
            $table->enum('status',['Sudah Ditemukan','Belum Ditemukan'])->default('Belum Ditemukan'); // Status barang sebagai boolean (0 = hilang, 1 = ditemukan)
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete(); // Foreign key mengarah ke tabel 'users'
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

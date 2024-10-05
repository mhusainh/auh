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
        Schema::create('orang_hilangs', function (Blueprint $table) {
            $table->id(); // ID untuk orang hilang
            $table->string('nama_orang'); // Nama orang hilang
            $table->integer('usia'); // Usia orang hilang
            $table->string('alamat_orang');
            $table->text('deskripsi_orang'); // Deskripsi orang hilang
            $table->string('gambar_orang')->nullable(); // Gambar orang hilang, bisa nullable jika gambar tidak wajib
            $table->enum('status',['Sudah Ditemukan','Belum Ditemukan'])->default('Belum Ditemukan'); // Status barang sebagai boolean (0 = hilang, 1 = ditemukan)
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

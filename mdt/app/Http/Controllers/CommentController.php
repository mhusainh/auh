<?php

namespace App\Http\Controllers;

use App\Models\BarangHilang;
use App\Models\OrangHilang;
use App\Models\CommentBarang;
use App\Models\CommentOrang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CommentController extends Controller
{
    public function uploadBarang(Request $request, $encryptedId)
    {
        try {
            // Dekripsi ID yang dienkripsi
            $id = Crypt::decryptString($encryptedId);

            // Validasi input komentar
            $request->validate([
                'komentar' => 'required|string|max:500', // Maksimal sesuai kebutuhan Anda
            ]);

            // Cari entitas barang hilang berdasarkan ID yang telah didekripsi
            $barangHilang = BarangHilang::find($id);

            // Jika barang hilang tidak ditemukan, kembalikan error
            if (!$barangHilang) {
                return redirect()->route('lapor.barang')->with('error', 'Item tidak ditemukan.');
            }

            // Cek apakah pengguna sudah login
            if (!Auth::check()) {
                return redirect()->route('lapor.barang')->with('error', 'Anda harus login untuk mengirim komentar.');
            }

            // Simpan komentar ke dalam database
            $comment = new CommentBarang(); // Model yang sesuai untuk komentar
            $comment->komentar = $request->komentar; // Komentar dari input form
            $comment->barang_id = $id; // Menyimpan ID barang hilang yang berhubungan
            $comment->user_id = Auth::user()->id; // ID pengguna yang login
            $comment->save();

            // Jika berhasil, redirect ke halaman 'lapor.barang' dengan pesan sukses
            return redirect()->route('lapor.barang')->with('success', 'Komentar berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Menangani kesalahan umum lainnya
            return redirect()->route('lapor.barang')->with('error', 'Terjadi kesalahan saat mengirim komentar: ' . $e->getMessage());
        }
    }
    public function uploadOrang(Request $request, $encryptedId)
    {
        try {
            // Dekripsi ID yang dienkripsi
            $id = Crypt::decryptString($encryptedId);

            // Validasi input komentar
            $request->validate([
                'komentar' => 'required|string|max:500', // Maksimal sesuai kebutuhan Anda
            ]);

            // Cari entitas barang hilang berdasarkan ID yang telah didekripsi
            $orangHilang = OrangHilang::find($id);

            // Jika barang hilang tidak ditemukan, kembalikan error
            if (!$orangHilang) {
                return redirect()->route('lapor.orang')->with('error', 'Item tidak ditemukan.');
            }

            // Cek apakah pengguna sudah login
            if (!Auth::check()) {
                return redirect()->route('lapor.orang')->with('error', 'Anda harus login untuk mengirim komentar.');
            }

            // Simpan komentar ke dalam database
            $comment = new CommentOrang(); // Model yang sesuai untuk komentar
            $comment->komentar = $request->komentar; // Komentar dari input form
            $comment->orang_id = $id; // Menyimpan ID orang hilang yang berhubungan
            $comment->user_id = Auth::user()->id; // ID pengguna yang login
            $comment->save();

            // Jika berhasil, redirect ke halaman 'lapor.orang' dengan pesan sukses
            return redirect()->route('lapor.orang')->with('success', 'Komentar berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Menangani kesalahan umum lainnya
            return redirect()->route('lapor.orang')->with('error', 'Terjadi kesalahan saat mengirim komentar: ' . $e->getMessage());
        }
    }
}

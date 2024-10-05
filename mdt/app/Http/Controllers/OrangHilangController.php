<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\OrangHilang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

use Exception;

class OrangHilangController extends Controller
{
    public function index()
    {
        return view('buat-laporan-orang', ['title' => 'Buat Laporan Orang Hilang']);
    }

    public function fileUpload(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_orang' => 'required|string|max:255',
            'usia' => 'required|string|max:255', // Tetap sebagai string untuk memudahkan pemrosesan
            'alamat_orang' => 'required|string|max:255',
            'deskripsi_orang' => 'required|string',
            'gambar_orang' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Menggunakan nama input yang tepat
        ]);

        try {
            // Ambil input usia dan hapus kata 'tahun'
            $usiaInput = $request->usia;
            $usia = preg_replace('/[^0-9]/', '', $usiaInput); // Mengambil hanya angka dari string

            // Validasi usia agar tidak kosong
            if (empty($usia)) {
                return redirect()->back()->with('error', 'Usia tidak valid.');
            }

            // Inisialisasi variabel untuk path gambar
            $path = null;

            // Proses upload gambar jika ada file yang diunggah
            if ($request->hasFile('gambar_orang')) {
                $image = $request->file('gambar_orang');

                // Cek apakah gambar valid
                if ($image->isValid()) {
                    // Simpan gambar dengan nama hash ke folder public
                    $path = $image->storeAs(
                        'images/' . Auth::user()->id . '/OrangHilang',
                        $image->hashName(),
                        'public'
                    );

                    // Verifikasi apakah gambar berhasil disimpan
                    if (!$path) {
                        return redirect()->back()->with('error', 'Gagal menyimpan gambar.');
                    }
                } else {
                    return redirect()->back()->with('error', 'File gambar tidak valid.');
                }
            } else {
                return redirect()->back()->with('error', 'Tidak ada file gambar yang diupload.');
            }

            // Simpan data orang hilang ke database
            $orangHilang = new OrangHilang();
            $orangHilang->nama_orang = $request->nama_orang;
            $orangHilang->usia = intval($usia); // Ubah menjadi integer
            $orangHilang->alamat_orang = $request->alamat_orang;
            $orangHilang->deskripsi_orang = $request->deskripsi_orang;
            $orangHilang->user_id = Auth::user()->id;

            // Simpan path gambar hanya jika ada file gambar yang berhasil diunggah
            if ($path) {
                $orangHilang->gambar_orang = $path; // Pastikan untuk menggunakan field yang benar
            }
            $orangHilang->save();

            // Kembalikan pesan sukses
            return redirect()->route('laporan.orang')->with('success', 'Laporan orang hilang berhasil ditambahkan.');
        } catch (Exception $e) {
            // Tangkap error dan kembalikan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function showlaporan(Request $request)
    {
        $sortOrder = $request->query('sort', 'latest');

        if ($sortOrder == 'latest') {
            $orangHilang = OrangHilang::with('user')->latest()->get();
        } elseif ($sortOrder == 'oldest') {
            $orangHilang = OrangHilang::with('user')->oldest()->get();
        }


        return view('laporan-orang', ['title' => 'Orang Hilang'], compact('orangHilang', 'sortOrder'));
    }
}

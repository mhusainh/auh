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
            return redirect()->route('lapor.orang')->with('success', 'Laporan orang hilang berhasil ditambahkan.');
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

    public function editLaporan(Request $request, $encryptedId)
    {
        try {
            $id = Crypt::decryptString($encryptedId); // Ganti decrypt dengan Crypt::decryptString
            $orangHilang = OrangHilang::find($id);

            if (!$orangHilang) {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }

            return view('edit-laporan-orang', ['title' => 'Edit Laporan'], compact('orangHilang'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->back()->with('error', 'ID yang diberikan tidak valid.');
        }
    }

    public function updateLaporan(Request $request, $encryptedId)
    {
        try {
            // Dekripsi ID yang dienkripsi
            $id = Crypt::decryptString($encryptedId);
            $orangHilang = OrangHilang::find($id);

            // Periksa apakah data orang hilang ditemukan
            if (!$orangHilang) {
                return redirect()->back()->with('error', 'Data orang hilang tidak ditemukan.');
            }

            // Validasi input yang diizinkan untuk diperbarui
            $request->validate([
                'nama_orang' => 'nullable|string|max:255',
                'usia' => 'nullable|string|max:255',
                'alamat_orang' => 'nullable|string|max:255',
                'deskripsi_orang' => 'nullable|string',
                'gambar_orang' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048', // Validasi gambar
            ]);

            // Proses upload gambar jika ada file yang diunggah
            if ($request->hasFile('gambar_orang')) {
                // Jika ada gambar lama, hapus gambar lama
                if ($orangHilang->gambar_orang && Storage::disk('public')->exists($orangHilang->gambar_orang)) {
                    Storage::disk('public')->delete($orangHilang->gambar_orang);
                }
                // Upload gambar baru
                $file = $request->file('gambar_orang');
                $path = $file->storeAs('images/' . Auth::user()->id . '/OrangHilang', $file->hashName(), 'public');
                $orangHilang->gambar_orang = $path;
            }

            // Update field lainnya jika diberikan
            if ($request->filled('nama_orang')) {
                $orangHilang->nama_orang = $request->nama_orang;
            }
            if ($request->filled('usia')) {
                // Hanya ambil angka dari input usia
                $usia = preg_replace('/[^0-9]/', '', $request->usia);
                $orangHilang->usia = intval($usia);
            }
            if ($request->filled('alamat_orang')) {
                $orangHilang->alamat_orang = $request->alamat_orang;
            }
            if ($request->filled('deskripsi_orang')) {
                $orangHilang->deskripsi_orang = $request->deskripsi_orang;
            }

            // Simpan perubahan
            $orangHilang->update();

            return redirect()->route('profile')->with('success', 'Laporan orang hilang berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteLaporan($encryptedId)
    {
        try {
            // Dekripsi ID
            $id = Crypt::decryptString($encryptedId);

            // Cari orang hilang berdasarkan ID, jika tidak ditemukan, lempar 404
            $orangHilang = OrangHilang::findOrFail($id);

            // Daftar field gambar yang akan dihapus jika ada
            $gambarFields = ['gambar_orang'];

            // Loop melalui field gambar dan hapus jika file-nya ada di storage
            foreach ($gambarFields as $field) {
                if ($orangHilang->$field && Storage::disk('public')->exists($orangHilang->$field)) {
                    Storage::disk('public')->delete($orangHilang->$field); // Hapus file dari storage
                }
            }

            // Hapus record orang hilang setelah file dihapus
            $orangHilang->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'Data dan gambar berhasil dihapus.');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->back()->with('error', 'ID yang diberikan tidak valid.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function updateStatus(Request $request, $encryptedId)
    {
        $request->validate([
            'status' => 'required|in:Sudah Ditemukan',
        ]);
        try {
            $id = Crypt::decryptString($encryptedId);
            $orangHilang = OrangHilang::findOrFail($id);
            if (!$orangHilang) {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }

            $orangHilang->status = $request->status;

            $orangHilang->update();
            return redirect()->back()->with('success', 'Status berhasil diubah.');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->back()->with('error', 'ID yang diberikan tidak valid.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\BarangHilang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;


class BarangHilangController extends Controller
{
    public function index()
    {
        return view('buat-laporan', ['title' => 'Buat Laporan Barang Hilang']);
    }

    public function fileUpload(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'alamat_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'required|string',
            'gambar_barang1' => 'required|image|mimes:jpeg,jpg,png',
            'gambar_barang2' => 'nullable|image|mimes:jpeg,jpg,png',
            'gambar_barang3' => 'nullable|image|mimes:jpeg,jpg,png',
            'gambar_barang4' => 'nullable|image|mimes:jpeg,jpg,png',
            'gambar_barang5' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);

        if ($request->hasAny(['gambar_barang1', 'gambar_barang2', 'gambar_barang3', 'gambar_barang4', 'gambar_barang5'])) {
            $gambarFields = ['gambar_barang1', 'gambar_barang2', 'gambar_barang3', 'gambar_barang4', 'gambar_barang5'];
            $paths = [];
            foreach ($gambarFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $path = $file->storeAs('images/' . Auth::user()->id . '/BarangHilang', $file->hashName(), 'public');
                    $paths[$field] = $path;
                }
            }

            $barangHilang = new BarangHilang();
            $barangHilang->nama_barang = $request->nama_barang;
            $barangHilang->alamat_barang = $request->alamat_barang;
            $barangHilang->deskripsi_barang = $request->deskripsi_barang;
            $tanggal_hilang = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tanggal_hilang)->format('Y-m-d');
            $barangHilang->tanggal_hilang = $tanggal_hilang;
            $barangHilang->user_id = Auth::user()->id;
            foreach ($paths as $field => $path) {
                $barangHilang->$field = $path;
            }
            // dd($barangHilang);
            $barangHilang->save();
            return redirect()->route('lapor.barang')->with('success', 'user added successfully');
        }
    }
    public function showlaporan(Request $request)
    {
        $sortOrder = $request->query('sort', 'latest');

        if ($sortOrder == 'latest') {
            $barangHilang = BarangHilang::with('user')->latest()->get();
        } elseif ($sortOrder == 'oldest') {
            $barangHilang = BarangHilang::with('user')->oldest()->get();
        }


        return view('laporan', ['title' => 'Barang Hilang'], compact('barangHilang', 'sortOrder'));
    }

    public function editLaporan(Request $request, $encryptedId)
    {
        try {
            $id = Crypt::decryptString($encryptedId); // Ganti decrypt dengan Crypt::decryptString
            $barangHilang = BarangHilang::find($id);

            if (!$barangHilang) {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }

            return view('edit-laporan', ['title' => 'Edit Laporan'], compact('barangHilang'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->back()->with('error', 'ID yang diberikan tidak valid.');
        }
    }

    public function updateLaporan(Request $request, $encryptedId)
    {
        try {
            $id = Crypt::decryptString($encryptedId); // Ganti decrypt dengan Crypt::decryptString
            $barangHilang = BarangHilang::find($id);
            // Check if the record exists
            if (!$barangHilang) {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }

            // Validasi input yang diizinkan diupdate
            $request->validate([
                'nama_barang' => 'nullable|string|max:255',
                'alamat_barang' => 'nullable|string|max:255',
                'deskripsi_barang' => 'nullable|string',
                'gambar_barang1' => 'nullable|image|mimes:jpeg,jpg,png',
                'gambar_barang2' => 'nullable|image|mimes:jpeg,jpg,png',
                'gambar_barang3' => 'nullable|image|mimes:jpeg,jpg,png',
                'gambar_barang4' => 'nullable|image|mimes:jpeg,jpg,png',
                'gambar_barang5' => 'nullable|image|mimes:jpeg,jpg,png',
            ]);

            // Jika ada gambar yang diunggah, hapus gambar lama dan update dengan yang baru
            $gambarFields = ['gambar_barang1', 'gambar_barang2', 'gambar_barang3', 'gambar_barang4', 'gambar_barang5'];
            foreach ($gambarFields as $field) {
                if ($request->hasFile($field)) {
                    // Jika ada gambar sebelumnya, hapus file lama
                    if ($barangHilang->$field && Storage::disk('public')->exists($barangHilang->$field)) {
                        Storage::disk('public')->delete($barangHilang->$field);
                    }
                    // Upload file baru
                    $file = $request->file($field);
                    $path = $file->storeAs('images/' . Auth::user()->id . '/BarangHilang', $file->hashName(), 'public');
                    $barangHilang->$field = $path;
                }
            }
            // Update field lainnya jika diberikan
            if ($request->filled('nama_barang')) {
                $barangHilang->nama_barang = $request->nama_barang;
            }
            if ($request->filled('alamat_barang')) {
                $barangHilang->alamat_barang = $request->alamat_barang;
            }
            if ($request->filled('deskripsi_barang')) {
                $barangHilang->deskripsi_barang = $request->deskripsi_barang;
            }
            if ($request->filled('tanggal_hilang')) {
                $tanggal_hilang = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tanggal_hilang)->format('Y-m-d');
                $barangHilang->tanggal_hilang = $tanggal_hilang;
            }

            // Simpan perubahan
            $barangHilang->update();

            return redirect()->route('profile')->with('success', 'Laporan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function deleteLaporan($encryptedId)
    {
        try {
            // Dekripsi ID
            $id = Crypt::decryptString($encryptedId);

            // Cari barang hilang berdasarkan ID, jika tidak ditemukan, lempar 404
            $barangHilang = BarangHilang::findOrFail($id);

            // Daftar field gambar yang akan dihapus jika ada
            $gambarFields = ['gambar_barang1', 'gambar_barang2', 'gambar_barang3', 'gambar_barang4', 'gambar_barang5'];

            // Loop melalui field gambar dan hapus jika file-nya ada di storage
            foreach ($gambarFields as $field) {
                if ($barangHilang->$field && Storage::disk('public')->exists($barangHilang->$field)) {
                    Storage::disk('public')->delete($barangHilang->$field); // Hapus file dari storage
                }
            }

            // Hapus record barang hilang setelah file dihapus
            $barangHilang->delete();

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
            $barangHilang = BarangHilang::findOrFail($id);
            if (!$barangHilang) {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }

            $barangHilang->status = $request->status;
            $barangHilang->update();
            return redirect()->back()->with('success', 'Status berhasil diubah.');
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->back()->with('error', 'ID yang diberikan tidak valid.');
        }
    }
}

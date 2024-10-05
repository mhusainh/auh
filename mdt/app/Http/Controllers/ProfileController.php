<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BarangHilang;
use App\Models\OrangHilang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class ProfileController extends Controller
{
    public function index($encryptedId)
    {
        try {
            // Decrypt the ID
            $id = Crypt::decryptString($encryptedId);

            // Retrieve the profile by the decrypted ID
            $user = User::findOrFail($id); // Menggunakan findOrFail agar otomatis melempar 404 jika tidak ditemukan
            return view('edit-profile', ['title' => 'Profile'], compact('user'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404); // If the decryption fails
        }
    }

    public function updateEmail(Request $request, $encryptedId)
    {
        $request->validate([
            'new_data' => 'required|email|unique:users,email', // Pastikan email unik
        ], [
            'new_data.unique' => 'Email ini sudah dipakai. Silakan gunakan email lain.',
        ]);

        try {
            $id = Crypt::decryptString($encryptedId);
            $user = User::find($id);
            $user->email = $request->new_data;
            $user->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Terjadi kesalahan.']);
        }
    }

    public function updatePhone(Request $request, $encryptedId)
    {
        $request->validate([
            'new_data' => 'required|numeric|digits_between:10,15|unique:users,nomorhp', // Nomor HP harus unik
        ], [
            'new_data.unique' => 'Nomor HP ini sudah dipakai. Silakan gunakan nomor lain.',
        ]);

        try {
            $id = Crypt::decryptString($encryptedId);
            $user = User::find($id);
            $user->nomorhp = $request->new_data;
            $user->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Terjadi kesalahan.']);
        }
    }


    public function updatePicture(Request $request, $encryptedId)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:10240', // Validasi gambar
        ]);

        try {
            // Decrypt the ID
            $id = Crypt::decryptString($encryptedId);
            // Retrieve the user by the decrypted ID
            $user = User::findOrFail($id);

            if ($request->hasFile('file')) {
                // Tentukan path direktori gambar
                $directory = 'images/' . $user->id . '/Profile';

                // Hapus file lama jika ada
                if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                    Storage::disk('public')->delete($user->photo); // Hapus hanya file lama yang tersimpan di DB
                }

                // Simpan gambar baru ke folder "images/{user_id}/Profile"
                $file = $request->file('file');
                $path = $file->storeAs($directory, $file->hashName(), 'public');

                // Update path gambar baru ke database
                $user->update(['photo' => $path]);

                return response()->json([
                    'success' => true,
                    'photo' => Storage::url($user->photo)
                ]);
            }

            return response()->json(['success' => false], 400); // Berikan status code 400 jika file tidak ada

        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['success' => false, 'error' => 'Invalid encrypted ID'], 400);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500); // Internal server error
        }
    }

    public function showProfile()
    {
        $barangHilang = BarangHilang::where('user_id', Auth::user()->id)
            ->orderByRaw("CASE WHEN status = 'Belum Ditemukan' THEN 1 ELSE 2 END") // Prioritaskan yang belum ditemukan
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan yang paling baru
            ->get();

        $orangHilang = OrangHilang::where('user_id', Auth::user()->id)
            ->orderByRaw("CASE WHEN status = 'Belum Ditemukan' THEN 1 ELSE 2 END") // Prioritaskan yang belum ditemukan
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan yang paling baru
            ->get();

        return view('profile', [
            'title' => 'Profile',
            'barangHilang' => $barangHilang,
            'orangHilang' => $orangHilang,
        ]);
    }
}

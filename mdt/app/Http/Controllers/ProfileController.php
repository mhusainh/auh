<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class profileController extends Controller
{
    public function index($encryptedId){
        try {
            // Decrypt the ID
            $id = Crypt::decryptString($encryptedId);

            // Retrieve the profile by the decrypted ID
            $user = User::find($id);
            
            if (!$user) {
                abort(404); // If user not found
            }
            return view('edit-profile', ['title' => 'Profile'], compact('user'));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404); // If the decryption fails
        }
        
    }

    public function updateEmail(Request $request, $id)
    {
        $request->validate([
            'new_data' => 'required|email', // Pastikan email ada dan formatnya benar
        ]);
        $user = User::find($id);
        if ($user) {
            $user->email = $request->new_data;
            $user->update();
            return redirect()->back()->with('success', 'Email updated successfully!');
        }
        return redirect()->back()->with('error', 'User not found');
    }

    public function updatePhone(Request $request, $id)
    {
        $request->validate([
            'new_data' => 'required|numeric|digits_between:10,15', // Pastikan nomor HP valid
        ]);
        $user = User::find($id);
        if ($user) {
            $user->nomorhp = $request->new_data;
            $user->update();
            return redirect()->back()->with('success', 'Phone number updated successfully!');
        }
        return redirect()->back()->with('error', 'User not found');
    }
    

    public function updatePicture(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:10240', // Validasi gambar
        ]);

        $user = User::find($id);
        
        if ($request->hasFile('file')) {
            // Tentukan path direktori gambar
            $directory = 'images/' . $user->id . '/Profile/'; // Pastikan konsisten dengan huruf kecil

            // Cek apakah ada file lama di direktori
            $existingFiles = Storage::files($directory);
            if (!empty($existingFiles)) {
                // Hapus semua file di direktori
                foreach ($existingFiles as $file) {
                    if (Storage::exists($file)) {
                        Storage::delete($file);
                    }
                }
            }

            // Simpan gambar baru ke folder "images/{user_id}/profile"
            $file = $request->file('file');
            $path = $file->storeAs($directory, $file->hashName(), 'public');
            
            // Simpan path gambar baru ke dalam database
            $user->photo = $path;
            $user->save();

            return response()->json(['success' => true, 'photo' => Storage::url($user->photo)]);

        }

        return response()->json(['success' => false]);
    }

}

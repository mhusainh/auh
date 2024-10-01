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
        $user = User::find($id);
        $user->email = $request->input('new-data');
        $user->save();
        return redirect()->back()->with('success', 'Email updated successfully!');
    }

    public function updatePhone(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->nomorhp = $request->new_data;
            $user->update();
            return redirect()->back()->with('success', 'Phone number updated successfully!');
        }
        return redirect()->back()->with('error', 'User not found');
    }
    

    public function updateProfilePicture(Request $request, $id)
    {
        $user = User::find($id);
        $file = $request->file('file-input');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img'), $filename);
        $user->profile_picture = $filename;
        $user->save();
        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }
}

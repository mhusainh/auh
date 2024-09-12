<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', ['title' => 'Website Terminal']);
    }

    public function authenticate(Request $request)
    {
        // Validasi input untuk email atau nomor telepon
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->passes()) {
            // Check if input is email or phone number
            $credentials = filter_var($request->email, FILTER_VALIDATE_EMAIL)
                ? ['email' => $request->email, 'password' => $request->password]
                : ['nomorhp' => $request->email, 'password' => $request->password];

            if (Auth::attempt($credentials)) {
                return redirect()->route('home');
            } else {
                return redirect()->route('account.login')->withErrors(['email' => 'Invalid email or password']);
            }
        } else {
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }
}

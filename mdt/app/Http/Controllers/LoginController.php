<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login', ['title' => 'Website Terminal']);
    }
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->passes()) {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('home');
            }else{
                return redirect()->route('account.login')->with('Invalid email or password');
            }
        }else{
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }
    }
    public function logout(){
      Auth::logout();
      return redirect()->route('account.login');
    }
}

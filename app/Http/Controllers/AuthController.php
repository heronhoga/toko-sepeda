<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function welcome() {
        return view('welcome');
    }

    public function index() {
        return view('login');
    }


    
    public function login(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('web')->attempt($credentials)) {
    
            $userData = DB::table('supervisors')
                ->where('email', $request->email)
                ->first();
    

            $request->session()->put('user_data', $userData);
    
            return redirect('home')->with('message', 'Anda berhasil masuk');
        } else {
            return redirect('login')->with('message', 'Mohon masukkan data yang benar');
        }
    }

    public function logout() {
        request()->session()->invalidate();
        return redirect()->route('welcome');
    }
    
}

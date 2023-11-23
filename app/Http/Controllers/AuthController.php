<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    function index() {
        return view('welcome');
    }
    function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
    
        $loginData = [
            'username' => $request->username,
            'password' => $request->password
        ];
    
        if (Auth::attempt($loginData)) {
            // Authentication successful, user is now logged in
            $user = Auth::user(); // Retrieve authenticated user using Auth::user()
    
            $dataSession = [
                'username' => $user->username,
                'nama_user' => $user->nama_user,
                'id_user' => $user->id
            ];
    
            $request->session()->put('user_data', $dataSession);
    
            return redirect('home')->with('message', 'Anda berhasil masuk');
        } else {
            // Authentication failed
            return 'gagal';
        }
    }
    
    
}

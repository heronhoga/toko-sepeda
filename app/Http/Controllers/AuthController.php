<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $request) {
        
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);
        

        $loginData = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($loginData)) {
            return 'sukses';
        } else {
            return 'gagal';
        }
    }
}

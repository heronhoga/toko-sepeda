<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function profileIndex() {
        $data = DB::select("
        SELECT * FROM supervisors
        WHERE id = " . session('user_data')->id
        );

        $data = $data[0];
        return view('users.profile')->with('data', $data);
    }

    public function profileEdit($id) {
        $data = DB::select("
        SELECT * FROM supervisors
        WHERE id = $id"
        );

        $data = $data[0];
        return view('users.editprofile')->with('data', $data);
    }
}

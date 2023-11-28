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

    public function profileUpdate(Request $request, $id) {
        // dd($request->all());
        $request->validate([
            'nama_supervisor' => 'required',
            'email' => 'required|email',
            'nomor_telepon' => 'required|numeric',
        ]);

        DB::update("
        UPDATE supervisors
        SET nama_supervisor = ?,
            email = ?,
            nomor_telepon = ?
        WHERE id = ?
    ", [
        $request->nama_supervisor,
        $request->email,
        $request->nomor_telepon,
        $id
    ]);

    return redirect()->route('profileIndex');

    }
}

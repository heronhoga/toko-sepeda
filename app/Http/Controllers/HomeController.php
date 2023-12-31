<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {

        $data = DB::select('
        SELECT users.*, transaksi.*, sepeda.*
        FROM users
        INNER JOIN transaksi ON users.id = transaksi.id_user
        INNER JOIN sepeda ON transaksi.id_sepeda = sepeda.id_sepeda
        WHERE sepeda.deleted_at IS NULL
        ORDER BY transaksi.tanggal_transaksi DESC
        LIMIT 5

        ');
        // dd($data);

    return view('home')->with('data', $data);
    }
}

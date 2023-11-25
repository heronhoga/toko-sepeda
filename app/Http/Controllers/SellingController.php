<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellingController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'latest');

        $sortColumn = 'transaksi.tanggal_transaksi';
        $sortDirection = 'DESC';

        $searchTerm = $request->input('search', '');

        switch ($sortBy) {
            case 'alphabet':
                $sortColumn = 'sepeda.nama_sepeda';
                $sortDirection = 'ASC';
                break;
            case 'reversed':
                $sortColumn = 'sepeda.nama_sepeda';
                $sortDirection = 'DESC';
                break;
            case 'latest':
                $sortColumn = 'transaksi.tanggal_transaksi';
                break;
            case 'oldest':
                $sortColumn = 'transaksi.tanggal_transaksi';
                $sortDirection = 'ASC';
                break;
        }

        $data = DB::select("
            SELECT users.*, transaksi.*, sepeda.*, transaksi.harga AS harga_akhir
            FROM users
            INNER JOIN transaksi ON users.id = transaksi.id_user
            INNER JOIN sepeda ON transaksi.id_sepeda = sepeda.id_sepeda
            ORDER BY $sortColumn $sortDirection
        ");

        if ($searchTerm !== '') {
            $data = DB::select("
                SELECT users.*, transaksi.*, sepeda.*, transaksi.harga AS harga_akhir
                FROM users
                INNER JOIN transaksi ON users.id = transaksi.id_user
                INNER JOIN sepeda ON transaksi.id_sepeda = sepeda.id_sepeda
                WHERE sepeda.nama_sepeda LIKE '%$searchTerm%'
                ORDER BY $sortColumn $sortDirection
            ");
        }

        return view('transaksi.datapenjualan')->with('data', $data);
    }
}

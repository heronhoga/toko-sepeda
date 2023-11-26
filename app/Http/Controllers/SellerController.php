<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    public function index(Request $request) {
        $sortBy = $request->input('sort_by', 'alphabet');
        $sortColumn = 'nama_penjual';
        $sortDirection = 'DESC';
        $searchTerm = $request->input('search', '');

        switch ($sortBy) {
            case 'alphabet':
                $sortColumn = 'nama_penjual';
                $sortDirection = 'ASC';
                break;
            case 'reversed':
                $sortColumn = 'sellers.nama_penjual';
                $sortDirection = 'DESC';
                break;
        }

        $data = DB::select("
        SELECT *
        FROM sellers
        WHERE sellers.deleted_at IS NULL
        ORDER BY $sortColumn $sortDirection
    ");

    if ($searchTerm !== '') {
        $data = DB::select("
        SELECT *
        FROM sellers
        WHERE sellers.nama_penjual LIKE '%$searchTerm%'
        AND sellers.deleted_at IS NULL
        ORDER BY $sortColumn $sortDirection
        ");
    }
        return view ('sellers.listpenjual')->with('data', $data);
    }
}

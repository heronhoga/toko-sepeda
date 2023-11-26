<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperviseController extends Controller
{
    public function index(Request $request) {
        $sortBy = $request->input('sort_by', 'alphabet');
        $sortColumn = 'sellers.nama_penjual';
        $sortDirection = 'DESC';
        $searchTerm = $request->input('search', '');

        switch ($sortBy) {
            case 'alphabet':
                $sortColumn = 'sellers.nama_penjual';
                $sortDirection = 'ASC';
                break;
            case 'reversed':
                $sortColumn = 'sellers.nama_penjual';
                $sortDirection = 'DESC';
                break;
        }

        $data = DB::select("
        SELECT sellers.*, supervisors.*, sellers.nomor_telepon AS sellerphone, supervisors.nomor_telepon AS supervisorphone
        FROM sellers
        INNER JOIN supervisors ON sellers.id_supervisor = supervisors.id
        ORDER BY $sortColumn $sortDirection
    ");

    if ($searchTerm !== '') {
        $data = DB::select("
        SELECT sellers.*, supervisors.*, sellers.nomor_telepon AS sellerphone, supervisors.nomor_telepon AS supervisorphone
        FROM sellers
        INNER JOIN supervisors ON sellers.id_supervisor = supervisors.id
        WHERE sellers.nama_penjual LIKE '%$searchTerm%'
        ORDER BY $sortColumn $sortDirection
        ");
    }

        return view('sellers.datapenjual')->with('data', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BikeController extends Controller
{
    public function index(Request $request) {
        $sortBy = $request->input('sort_by', 'alphabet');
        $sortColumn = 'nama_sepeda';
        $sortDirection = 'DESC';
        $searchTerm = $request->input('search', '');

        switch ($sortBy) {
            case 'alphabet':
                $sortColumn = 'nama_sepeda';
                $sortDirection = 'ASC';
                break;
            case 'reversed':
                $sortColumn = 'nama_sepeda';
                $sortDirection = 'DESC';
                break;
        }

        $data = DB::select("
        SELECT *
        FROM sepeda
        WHERE sepeda.deleted_at IS NULL
        ORDER BY $sortColumn $sortDirection
    ");

    if ($searchTerm !== '') {
        $data = DB::select("
        SELECT *
        FROM sepeda
        WHERE sepeda.nama_sepeda LIKE '%$searchTerm%'
        AND sepeda.deleted_at IS NULL
        ORDER BY $sortColumn $sortDirection
        ");
    }
        return view ('sepeda.listsepeda')->with('data', $data);
    }

    public function createBikePage() {
        $data = DB::select("
        SELECT *
        FROM sellers
        ");
        return view ('sepeda.createbike')->with('data', $data);
    }

    public function createBike(Request $request) {
        $request->validate([
            'merek_sepeda' => 'required',
            'jenis_sepeda' => 'required',
            'nama_sepeda' => 'required',
            'masa_garansi' => 'required|numeric',
            'harga' => 'required',
            'id_penjual' => 'required'
        ]);

        DB::insert("
        INSERT INTO sepeda (merek_sepeda, jenis_sepeda, nama_sepeda, masa_garansi, harga, id_penjual)
        VALUES (?, ?, ?, ?, ?, ?)
        ", [
        $request->merek_sepeda,
        $request->jenis_sepeda,
        $request->nama_sepeda,
        $request->masa_garansi,
        $request->harga,
        $request->id_penjual,
    ]);

    return redirect()->route('bikeIndex');
    }

    public function editBikePage($id) {
        $data = DB::select("
        SELECT *
        FROM sellers
        ");

        $currentdata = DB::select("
        SELECT *
        FROM sepeda
        WHERE id_sepeda = $id
        ");

        $currentdata = $currentdata[0];
        return view ('sepeda.editsepeda')->with('data', $data)->with('currentdata', $currentdata);
    }

    public function editBike(Request $request, $id) {
        $request->validate([
            'merek_sepeda' => 'required',
            'jenis_sepeda' => 'required',
            'nama_sepeda' => 'required',
            'masa_garansi' => 'required|numeric',
            'harga' => 'required',
            'id_penjual' => 'required'
        ]);

        DB::update("
        UPDATE sepeda
        SET merek_sepeda = ?,
            jenis_sepeda = ?,
            nama_sepeda = ?,
            masa_garansi = ?,
            harga = ?,
            id_penjual = ?
        WHERE id_sepeda = ?
    ", [
        $request->merek_sepeda,
        $request->jenis_sepeda,
        $request->nama_sepeda,
        $request->masa_garansi,
        $request->harga,
        $request->id_penjual,
        $id
    ]);

    return redirect()->route('bikeIndex');
    }

    public function deleteBike($id) {
        $date = date("Y-m-d");
        DB::update("
        UPDATE sepeda
        SET deleted_at = '$date'
        WHERE id_sepeda = ?
    ", [
        $id
    ]);

    return redirect()->route('bikeIndex');
    }

    public function trashBikeIndex(Request $request) {
        $sortBy = $request->input('sort_by', 'alphabet');
        $sortColumn = 'nama_sepeda';
        $sortDirection = 'DESC';
        $searchTerm = $request->input('search', '');

        switch ($sortBy) {
            case 'alphabet':
                $sortColumn = 'nama_sepeda';
                $sortDirection = 'ASC';
                break;
            case 'reversed':
                $sortColumn = 'nama_sepeda';
                $sortDirection = 'DESC';
                break;
        }

        $data = DB::select("
        SELECT *
        FROM sepeda
        WHERE sepeda.deleted_at IS NOT NULL
        ORDER BY $sortColumn $sortDirection
    ");

    if ($searchTerm !== '') {
        $data = DB::select("
        SELECT *
        FROM sepeda
        WHERE sepeda.nama_sepeda LIKE '%$searchTerm%'
        AND sepeda.deleted_at IS NOT NULL
        ORDER BY $sortColumn $sortDirection
        ");
    }

        return view ('sepeda.trashbike')->with('data', $data);
    }

    public function hardDeleteBike($id) {
        DB::delete("
        DELETE FROM sepeda
        WHERE id_sepeda = ?
    ", [
        $id
    ]);

    return redirect()->route('trashBikeIndex');
    }

    public function recoverBike($id) {

        DB::update("
        UPDATE sepeda
        SET deleted_at = NULL
        WHERE id_sepeda = ?
    ", [
        $id
    ]);

    return redirect()->route('trashBikeIndex');
    }
}

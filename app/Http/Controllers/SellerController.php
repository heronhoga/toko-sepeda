<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    //CREATE SELLER
    public function createSellerPage() {
        $data = DB::select("
        SELECT *
        FROM supervisors
        ");
        return view ('sellers.createseller')->with('data', $data);
    }

    public function createSeller(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'nama_penjual' => 'required',
            'nomor_telepon' => 'required|numeric|max:999999999999',
            'status' => 'required',
            'id_supervisor' => 'required'
        ]);

        $password = Hash::make($request->password);

        DB::insert("
        INSERT INTO sellers (email, password, nama_penjual, nomor_telepon, status, id_supervisor)
        VALUES (?, ?, ?, ?, ?, ?)
        ", [
        $request->email,
        $password,
        $request->nama_penjual,
        $request->nomor_telepon,
        $request->status,
        $request->id_supervisor
    ]);

    return redirect()->route('seller');
    }

    public function editSellerPage($id) {
        $data = DB::select("
        SELECT *
        FROM supervisors
        ");

        $currentdata = DB::select("
        SELECT *
        FROM sellers
        WHERE id = $id
        ");

        $currentdata = $currentdata[0];
        return view ('sellers.editseller')->with('data', $data)->with('currentdata', $currentdata);
    }

    public function editSeller(Request $request, $id) {
        $request->validate([
            'email' => 'required',
            'nama_penjual' => 'required',
            'nomor_telepon' => 'required|numeric|max:999999999999',
            'status' => 'required',
            'id_supervisor' => 'required'
        ]);

        DB::update("
        UPDATE sellers
        SET email = ?,
            nama_penjual = ?,
            nomor_telepon = ?,
            status = ?,
            id_supervisor = ?
        WHERE id = ?
    ", [
        $request->email,
        $request->nama_penjual,
        $request->nomor_telepon,
        $request->status,
        $request->id_supervisor,
        $id
    ]);

    return redirect()->route('seller');
    }

    public function deleteSeller($id) {
        $date = date("Y-m-d");
        DB::update("
        UPDATE sellers
        SET deleted_at = '$date'
        WHERE id = ?
    ", [
        $id
    ]);

    return redirect()->route('seller');
    }

    public function trashSellerIndex(Request $request) {
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
        WHERE sellers.deleted_at IS NOT NULL
        ORDER BY $sortColumn $sortDirection
    ");

    if ($searchTerm !== '') {
        $data = DB::select("
        SELECT *
        FROM sellers
        WHERE sellers.nama_penjual LIKE '%$searchTerm%'
        AND sellers.deleted_at IS NOT NULL
        ORDER BY $sortColumn $sortDirection
        ");
    }

        return view ('sellers.trashseller')->with('data', $data);
    }

    public function hardDelete($id) {
        DB::delete("
        DELETE FROM sellers
        WHERE id = ?
    ", [
        $id
    ]);

    return redirect()->route('trashSellerIndex');
    }

    public function recover($id) {

        DB::update("
        UPDATE sellers
        SET deleted_at = NULL
        WHERE id = ?
    ", [
        $id
    ]);

    return redirect()->route('trashSellerIndex');
    }
}

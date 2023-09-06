<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sampah_kategori;
use App\Models\Sampah_data;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Sampah_kategori::select('*')->get();
        $count      = $categories->count();
        $data       = [
            'items' => !empty($count) ? $categories->toArray() : []
        ];
        return view('client.dashboard', $data);
    }

    public function data_sampah(Request $request)
    {
        $sampah_data = DB::table('sampah_data')
            ->join('sampah_kategori', 'sampah_data.sampah_kategori_id', '=', 'sampah_kategori.id')
            ->select('sampah_data.*', 'sampah_kategori.nama AS nama_kategori')
            ->where('sampah_data.sampah_kategori_id', $request->sampah_kategori_id)
            ->get();

        $count = $sampah_data->count();
        $data  = ['title' => 'Hitung Harga Sampah', 'items' => !empty($count) ? $sampah_data : []];
        return view('client.sampah_data_calculate', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

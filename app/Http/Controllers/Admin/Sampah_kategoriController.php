<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sampah_kategori;

class Sampah_kategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Sampah_kategori::orderBy('id', 'desc')->paginate(5);
        $count      = Sampah_kategori::count();
        $data = [
            'title' => 'Kategori Bank Sampah',
            'items' => ($count == 0) ? [] : $categories
        ];
        return view('admin.sampah_kategori', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori Bank Sampah'
        ];
        return view('admin.sampah_kategori_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
        ]);

        Sampah_kategori::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori')->with(['success' => sprintf('%s Berhasil Disimpan.', $request->nama)]);
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
        $categories = Sampah_kategori::findOrFail($id);
        $data       = ['title' => 'Edit Kategori Bank Sampah', 'item' => $categories];
        return view('admin.sampah_kategori_update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nama' => 'required',
        ]);
        $post = Sampah_kategori::findOrFail($id);
        $post->update([
            'nama' => $request->nama,
        ]);
        return redirect()->route('admin.kategori')->with(['success' => sprintf('%s Berhasil Diubah.', $request->nama)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Sampah_kategori::findOrFail($id);
        $categories->delete();
        return redirect()->route('admin.kategori')->with(['success' => sprintf('%s Berhasil Dihapus.', $categories->nama)]);
    }
}

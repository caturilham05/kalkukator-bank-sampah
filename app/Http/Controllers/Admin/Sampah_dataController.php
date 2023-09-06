<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sampah_data;
use App\Models\Sampah_kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Collection::paginate;

class Sampah_dataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = DB::table('sampah_data')
            ->join('sampah_kategori', 'sampah_data.sampah_kategori_id', '=', 'sampah_kategori.id')
            ->select('sampah_data.*', 'sampah_kategori.nama AS nama_kategori')
            ->paginate(5);

        $count = Sampah_data::count();

        $data  = [
            'title' => 'Data Bank Sampah',
            'items' => ($count == 0) ? [] : $datas
        ];
        return view('admin.sampah_data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Sampah_kategori::select('*')->get();
        $count      = $categories->count();
        $data       = [
            'title'      => 'Tambah Data Bank Sampah',
            'categories' => !empty($count) ? $categories->toArray() : []
        ];
        return view('admin.sampah_data_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'foto'            => 'image|mimes:jpeg,jpg,png|max:10048',
            'nama'            => 'required',
            'harga'           => 'required',
            'satuan'          => 'required'
        ]);

        if (!empty($request->hasFile('foto')))
        {
            $image = $request->file('foto');
            $image->storeAs('public/sampah', $image->hashName());
        }

        Sampah_data::create([
            'sampah_kategori_id' => $request->sampah_kategori_id,
            'nama'               => $request->nama,
            'deskripsi'          => $request->deskripsi,
            'harga'              => $request->harga,
            'satuan'             => $request->satuan,
            'foto'               => !empty($request->file('foto')) ? $image->hashName() : NULL
        ]);

        return redirect()->route('admin.dashboard')->with(['success' => sprintf('%s Berhasil Disimpan.', $request->nama)]);
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
        $categories = Sampah_kategori::select('*')->get();
        $datas      = Sampah_data::select('sampah_data')
            ->join('sampah_kategori', 'sampah_data.sampah_kategori_id', '=', 'sampah_kategori.id')
            ->select('sampah_data.*', 'sampah_kategori.nama AS nama_kategori')
            ->where('sampah_data.id', $id)->get()->toArray()[0];


        $data  = ['title' => 'Edit Data Bank Sampah', 'item' => $datas, 'categories' => $categories];
        return view('admin.sampah_data_update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'foto'   => 'image|mimes:jpeg,jpg,png|max:10048',
            'nama'   => 'required',
            'harga'  => 'required',
            'satuan' => 'required'
        ]);

        $post = Sampah_data::findOrFail($id);
        if (!empty($request->hasFile('foto')))
        {
            $image = $request->file('foto');
            $image->storeAs('public/sampah', $image->hashName());

            //delete old image
            Storage::delete('public/sampah/'.$post->foto);
        }

        $post->update([
            'sampah_kategori_id' => $request->sampah_kategori_id,
            'nama'               => $request->nama,
            'deskripsi'          => $request->deskripsi,
            'harga'              => $request->harga,
            'satuan'             => $request->satuan,
            'foto'               => !empty($request->hasFile('foto')) ? $image->hashName() : NULL
        ]);
        return redirect()->route('admin.dashboard')->with(['success' => sprintf('%s Berhasil Diubah.', $request->nama)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datas = Sampah_data::findOrFail($id);

        //delete image
        Storage::delete('public/sampah/'. $datas->foto);
        $datas->delete();
        return redirect()->route('admin.dashboard')->with(['success' => sprintf('%s Berhasil Dihapus.', $datas->nama)]);
    }
}

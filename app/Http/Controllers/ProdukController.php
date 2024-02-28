<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Satuan;
use CreateSatuansTable;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        $data = [
            'title' => 'Produk',
            'menu' => 'Produk',
            'submenu' => 'Data Produk',
            'contoh_user' => 'contoh_nama',
        ];
        return view('produk.index', compact('data', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        $data = [
            'title' => 'Tambah Produk',
            'menu' => 'Produk',
            'submenu' => 'Tambah Produk',
            'contoh_user' => 'contoh_nama',
        ];
        return view('produk.create', compact('data', 'kategori', 'satuan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produk',
            'nama_produk' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);

        Produk::create([
            'kode_produk' => $request->kode_produk, 
            'nama_produk' => $request->nama_produk, 
            'id_kategori' => $request->kategori, 
            'id_satuan' => $request->satuan, 
            'harga_beli' => $request->harga_beli, 
            'harga_jual' => $request->harga_jual, 
            'stok' => $request->stok, 
        ]);

        return redirect()->route('produk.index')->with('succes', 'Data Berhasil Disimpan')->with('alert-type', 'alert-success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::find($id);
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        $data = [
            'title' => 'Edit Produk',
            'menu' => 'Produk',
            'submenu' => 'Edit Produk',
            'contoh_user' => 'contoh_nama',
        ];

        return view('produk.edit', compact('data', 'produk', 'kategori', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);

        $data = [
            'kode_produk' => $request->kode_produk, 
            'nama_produk' => $request->nama_produk, 
            'id_kategori' => $request->kategori, 
            'id_satuan' => $request->satuan, 
            'harga_beli' => $request->harga_beli, 
            'harga_jual' => $request->harga_jual, 
            'stok' => $request->stok, 
        ];
        
        $produk = Produk::find($id);
        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Data Berhasil Diupdate')->with('alert-type', 'alert-primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produk::find($id)->delete();

        return redirect()->route('produk.index')->with('success', 'Data Berhasil Dihapus')->with('alert-type', 'alert-danger');
    }
}
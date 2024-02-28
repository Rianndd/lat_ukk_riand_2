<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        $data = [
            'title' => 'Kategori',
            'menu' => 'Kategori',
            'submenu' => 'Data Kategori',
            'contoh_user' => 'contoh_nama',
        ];

        return view('kategori.index', compact('kategori', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        $data = [
            'title' => 'Tambah Kategori',
            'menu' => 'Kategori',
            'submenu' => 'Tambah Kategori',
            'contoh_user' => 'contoh_nama',
        ];

        return view('kategori.create', compact('kategori', 'data'));
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
            'nama_kategori' => 'required|unique:kategori',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Data berhasil disimpan')->with('alert-type', 'alert-success');
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
        $kategori = Kategori::find($id);
        $data = [
            'title' => 'Edit Kategori',
            'menu' => 'Kategori',
            'submenu' => 'Edit Kategori',
            'contoh_user' => 'contoh_nama',
        ];

        return view('kategori.edit', compact('kategori', 'data'));
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
            'nama_kategori' => 'required',
        ]);
        
        $data = [
            'nama_kategori' => $request->nama_kategori,
        ];
        
        $kategori = Kategori::findOrFail($id);
        $kategori->update($data);

        return redirect()->route('kategori.index')->with('success', 'Data Berhasil Diedit')->with('alert-type', 'alert-primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        $kategori->delete();
        
        return redirect()->route('kategori.index')->with('success', 'Data Berhasil Dihapus')->with('alert-type', 'alert-danger');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = Satuan::all();
        $data = [
            'title' => 'Satuan',
            'menu' => 'Satuan',
            'submenu' => 'Data Satuan',
            'contoh_user' => 'contoh_nama',
        ];

        return view('satuan.index', compact('satuan', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $satuan = Satuan::all();
        $data = [
            'title' => 'Tambah Satuan',
            'menu' => 'Satuan',
            'submenu' => 'Tambah Satuan',
            'contoh_user' => 'contoh_nama',
        ];
        
        return view('satuan.create', compact('satuan', 'data'));
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
            'nama_satuan' => 'required|unique:satuan',
        ]);
        
        Satuan::create([
            'nama_satuan' => $request->nama_satuan,
        ]);

        return redirect()->route('satuan.index')->with('success', 'Data berhasil disimpan')->with('alert-type', 'alert-success');
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
        $satuan = Satuan::find($id);
        $data = [
            'title' => 'Edit Satuan',
            'menu' => 'Satuan',
            'submenu' => 'Edit Satuan',
            'contoh_user' => 'contoh_nama',
        ];

        return view('satuan.edit', compact('satuan', 'data'));
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
            'nama_satuan' => 'required',
        ]);

        $data = [
            'nama_satuan' => $request->nama_satuan,
        ];

        $satuan = Satuan::findOrFail($id);
        $satuan->update($data);

        return redirect()->route('satuan.index')->with('success', 'Data Berhasil Diupdate')->with('alert-type', 'alert-primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Satuan::find($id)->delete();

        return redirect()->route('satuan.index')->with('success', 'Data Berhasil Dihapus')->with('alert-type', 'alert-danger');
    }
}
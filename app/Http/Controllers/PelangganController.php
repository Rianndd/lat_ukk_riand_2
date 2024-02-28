<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        $data = [
            'title' => 'Pelanggan',
            'menu' => 'Pelanggan',
            'submenu' => 'Data Pelanggan',
            'contoh_user' => 'contoh nama',
        ];

        return view('pelanggan.index', compact('pelanggan', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Pelanggan',
            'menu' => 'Pelanggan',
            'submenu' => 'Tambah Pelanggan',
            'contoh_user' => 'contoh nama',
        ];

        return view('pelanggan.create', compact('data'));
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
            'nama_pelanggan' => 'required',
        ]);

        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil Disimpan')->with('alert-type', 'alert-success');
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
        $pelanggan = Pelanggan::find($id);
        $data = [
            'title' => 'Edit Pelanggan',
            'menu' => 'Pelanggan',
            'submenu' => 'Edit Pelanggan',
            'contoh_user' => 'contoh nama',
        ];

        return view('pelanggan.edit', compact('data', 'pelanggan'));
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
            'nama_pelanggan' => 'required',
        ]);
        
        $data = [
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon
        ];

        $pelanggan = Pelanggan::find($id);
        $pelanggan->update($data);

        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil Diedit')->with('alert-type', 'alert-info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pelanggan::find($id)->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil Dihapus')->with('alert-type', 'alert-info');
    }
}
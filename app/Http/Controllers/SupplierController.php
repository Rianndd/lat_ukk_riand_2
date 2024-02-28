<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        $data = [
            'title' => 'Supplier',
            'menu' => 'Supplier',
            'submenu' => 'Data Supplier',
            'contoh_user' => 'contoh nama',
        ];

        return view('supplier.index', compact('supplier', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Supplier',
            'menu' => 'Supplier',
            'submenu' => 'Tambah Supplier',
            'contoh_user' => 'contoh nama',
        ];

        return view('supplier.create', compact('data'));
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
            'nama_supplier' => 'required',
        ]);

        Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('supplier.index')->with('success', 'Data Berhasil Disimpan')->with('alert-type', 'alert-success');
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
        $supplier = Supplier::find($id);
        $data = [
            'title' => 'Edit Supplier',
            'menu' => 'Supplier',
            'submenu' => 'Edit Supplier',
            'contoh_user' => 'contoh nama',
        ];

        return view('supplier.edit', compact('supplier', 'data'));
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
            'nama_supplier' => 'required',
        ]);
        
        $data = [
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat,
        ];

        $supplier = Supplier::find($id);
        $supplier->update($data);

        return redirect()->route('supplier.index')->with('success', 'Data Berhasil Diedit')->with('alert-type', 'alert-primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::find($id)->delete();
        return redirect()->route('supplier.index')->with('success', 'Data Berhasil Dihapus')->with('alert-type', 'alert-danger');
    }
}
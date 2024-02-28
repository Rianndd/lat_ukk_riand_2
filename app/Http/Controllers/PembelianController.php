<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        $produk = Produk::all();
        $pembelian = Pembelian::all();
        $data = [
            'title' => 'Pembelian Stok',
            'menu' => 'Pembelian',
            'submenu' => 'Data Pembelian',
            'contoh_user' => 'contoh_nama',
        ];
        return view('pembelian.index', compact('data', 'supplier', 'produk', 'pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate and store data to the Pembelian table
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'id_supplier' => 'required|exists:supplier,id',
            'total_produk' => 'required|numeric|min:1',
            // ... other validations
        ]);

        $supplier = Supplier::find($request->id_supplier);

        $produk = Produk::find($request->id_produk);

        // Update stok in Produk table
        $produk->stok += $request->total_produk;
        $produk->save();

        // Ambil tanggal saat ini
        $tanggal = now(); // atau today() tergantung kebutuhan bisnis

        // Calculate and store total_harga to the Pembelian table
        $totalHarga = $produk->harga_beli * $request->total_produk;

        Pembelian::create([
            'id_supplier' => $request->id_supplier,
            'id_produk' => $request->id_produk,
            'total_produk' => $request->total_produk,
            'total_harga' => $totalHarga,
            'tanggal' => $tanggal,
        ]);

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        $pembelian = Pembelian::find($id);
        $produk = Produk::all();
        $data = [
            'title' => 'Pembelian Stok',
            'menu' => 'Pembelian',
            'submenu' => 'Transaksi Pembelian Stok',
            'contoh_user' => 'contoh_nama',
        ];
        return view('pembelian.detail', compact('data', 'pembelian', 'supplier', 'produk'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
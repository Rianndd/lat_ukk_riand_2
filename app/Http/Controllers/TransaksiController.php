<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\temp;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        $transaksi = Transaksi::all();
        $data = [
            'title' => 'Data Transaksi',
            'menu' => 'Transaksi',
            'submenu' => 'Data Transaksi',
            'contoh_user' => 'contoh nama',
        ];

        return view('transaksi.index', compact('data', 'transaksi', 'pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $produk = Produk::all();
        // $data = [
        //     'title' => 'Transaksi',
        //     'menu' => 'Transaksi',
        //     'submenu' => 'Transaksi Produk',
        //     'contoh_user' => 'contoh nama',
        // ];

        // return view('transaksi.create', compact('data', 'produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Simpan data ke dalam tabel Transaksi
        $transaksi = new Transaksi();
        $transaksi->id_pelanggan = $request->input('id_pelanggan'); // Mengambil id_pelanggan dari form
        $transaksi->total_harga = $request->input('total_harga');
        $transaksi->bayar = $request->input('bayar');
        $transaksi->kembalian = $request->input('kembalian');
        $transaksi->save();

        // Ambil data dari tabel temp
        $pindahTemp = temp::all(); // Ambil semua data dari tabel temp

        // Inisialisasi variabel untuk menyimpan transaksi detail yang valid
        $transaksiDetails = [];

        foreach ($pindahTemp as $row) {
            // Cek apakah produk masih tersedia
            $produk = Produk::find($row->id_produk);
            if ($produk && $produk->stok >= $row->jumlah) {
                // Jika produk masih tersedia, tambahkan ke transaksi detail
                $transaksiDetail = new TransaksiDetail();
                $transaksiDetail->id_transaksi = $transaksi->id;
                $transaksiDetail->id_produk = $row->id_produk;
                $transaksiDetail->jumlah = $row->jumlah;
                $transaksiDetail->save();

                // Kurangi stok produk
                $produk->stok -= $row->jumlah;
                $produk->save();

                // Tambahkan ke array transaksi detail yang valid
                $transaksiDetails[] = $transaksiDetail;
            }
        }

        // Hapus data dari tabel Keranjang Belanja (temp) hanya jika ada produk yang valid
        if (!empty($transaksiDetails)) {
            temp::truncate();
        }
        return view('transaksi.nota', compact('transaksi', 'transaksiDetails'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $temp = temp::all();
        $pelanggan = Pelanggan::find($id);
        $produk = Produk::all();
        $data = [
            'title' => 'Transaksi',
            'menu' => 'Transaksi',
            'submenu' => 'Transaksi Produk',
            'contoh_user' => 'contoh nama',
        ];

        return view('transaksi.create', compact('data', 'produk', 'pelanggan', 'temp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaksi::with('transaksiDetails')->find($id);

        // Pastikan transaksi dengan id yang diberikan ditemukan
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan');
        }

        return view('transaksi.detail', compact('transaksi'));
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
        Transaksi::find($id)->delete();

        return redirect()->route('transaksi.index')->with('success', 'Data Berhasil Dihapus')->with('alert-type', 'alert-success');
    }
}
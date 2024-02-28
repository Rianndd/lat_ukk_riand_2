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
            'submenu' => 'Data Supplier',
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


        // Ambil data dari tabel temp dan simpan ke TransaksiDetail
        $pindahTemp = temp::all(); // Ambil semua data dari tabel temp
        foreach ($pindahTemp as $row) {
            $transaksiDetail = new TransaksiDetail();
            $transaksiDetail->id_transaksi = $transaksi->id;
            $transaksiDetail->id_produk = $row->id_produk;
            $transaksiDetail->jumlah = $row->jumlah;
            $transaksiDetail->save();

            // Kurangi stok produk
            $produk = Produk::find($row->id_produk);
            $produk->stok -= $row->jumlah;
            $produk->save();
        }

        // Hapus data dari tabel Keranjang Belanja (temp)
        temp::truncate();

        // Load view dan konversi menjadi HTML
        $html = view('transaksi.nota', compact('transaksi'))->render();

        // Buat objek PDF
        $pdf = PDF::loadHtml($html);

        // Render PDF
        $pdf->setPaper('A8', 'portrait'); // Atur ukuran kertas ke A8 (seukuran struk) dan orientasinya menjadi portrait
        $pdf->render();

        // Simpan atau kirim PDF ke browser
        $pdf->stream('nota_transaksi.pdf');

        // Redirect pengguna kembali ke halaman indeks
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');

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
        $transaksi = Transaksi::find($id);
        $produk = Produk::get();
        $id_produk = request('id_produk');
        $produk_detail = Produk::find($id_produk);

            $data = [
                'title' => 'Tambah Transaksi',
                'menu' => 'Transaksi',
                'submenu' => 'Tambah Transaksi',
                'contoh_user' => 'contoh nama',
            ];

        return view('transaksi.create', compact('data', 'produk', 'produk_detail', 'transaksi'));
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
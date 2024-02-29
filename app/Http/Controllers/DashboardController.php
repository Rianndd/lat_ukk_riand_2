<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_produk = Produk::count();
        $jumlah_supplier = Supplier::count();
        $jumlah_pelanggan = Pelanggan::count();
        $jumlah_transaksi = Transaksi::count();
        $data = [
            'title' => 'Dashboard',
            'menu' => 'Dashboard',
            'contoh_user' => 'contoh_nama',
        ];
        return view('layouts.app', compact('data', 'jumlah_produk', 'jumlah_supplier', 'jumlah_pelanggan', 'jumlah_transaksi'));
    }
}
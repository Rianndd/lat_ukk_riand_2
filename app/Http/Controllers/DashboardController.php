<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'menu' => 'Dashboard',
            'contoh_user' => 'contoh_nama',
        ];

        return view('layouts.app', compact('data'));
    }
}
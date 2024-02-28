<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $data = [
            'title' => 'User',
            'menu' => 'User',
            'submenu' => 'Data User',
            'contoh_user'=> 'contoh_nama',
        ];

        return view('users.index', compact('user', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah User',
            'menu' => 'User',
            'submenu' => 'Tambah User',
            'contoh_user' => 'contoh_nama',
        ];
        
        return view('users.create', compact('data'));
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
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'level' => 'required',
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);
        
        return redirect()->route('users.index')->with('success', 'Data Berhasil Disimpan')->with('alert-type', 'alert-success');
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
        $user = User::find($id);
        $data = [
            'title' => 'Edit User',
            'menu' => 'User',
            'submenu' => 'Tambah User',
            'contoh_user' => 'nama_user'
        ];

        return view('users.edit', compact('user', 'data'));
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
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'nullable',
            'level' => 'required',
        ]);

        if ($request->filled('password')) {
            $password = Hash::make($request->password);
        } else {
            $password = $user->password;
        }

        $data = ([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $password,
            'level' => $request->level,
        ]);

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data Berhasil Diupdate')->with('alert-type', 'alert-primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        
        return redirect()->route('users.index')->with('success', 'Data Berhasil Dihapus')->with('alert-type', 'alert-danger');
    }
}
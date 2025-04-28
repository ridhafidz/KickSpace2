<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Menampilkan semua roles
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Menampilkan form untuk membuat role baru
    public function create()
    {
        return view('roles.create');
    }

    // Menyimpan role baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|unique:roles|max:255',
            'description' => 'nullable|max:500',
        ]);

        // Menyimpan data role ke database
        Role::create($request->all());

        // Redirect ke halaman index setelah berhasil menyimpan
        return redirect()->route('roles.index');
    }

    // Menampilkan form untuk mengedit role
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Mengupdate role ke database
    public function update(Request $request, Role $role)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|max:500',
        ]);

        // Mengupdate data role
        $role->update($request->all());

        // Redirect ke halaman index setelah berhasil mengupdate
        return redirect()->route('roles.index');
    }

    // Menghapus role
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index');
    }
}

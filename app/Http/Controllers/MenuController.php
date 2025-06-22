<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        return view('menus.create');
    }

    public function store(Request $request)
    {
        // GABUNGAN: Validasi Anda + validasi untuk icon_class
        $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'link_menu' => 'nullable|string|max:255|unique:menus,link_menu',
            'icon_class' => 'nullable|string|max:255', // Tambahan
        ]);

        // Menggunakan metode create eksplisit agar lebih aman dan jelas
        Menu::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'link_menu' => $request->link_menu,
            'icon_class' => $request->icon_class, // Tambahan
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
    }

    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        // GABUNGAN: Validasi Anda + validasi untuk icon_class
        $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'link_menu' => 'nullable|string|max:255|unique:menus,link_menu,' . $menu->id,
            'icon_class' => 'nullable|string|max:255', // Tambahan
        ]);

        // Menggunakan metode update eksplisit
        $menu->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'link_menu' => $request->link_menu,
            'icon_class' => $request->icon_class, // Tambahan
        ]);

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu deleted.');
    }
}

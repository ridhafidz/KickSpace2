<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use App\Models\SettingMenu;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $menus = Menu::all();

        $selected = SettingMenu::all()->groupBy('role_id')->map(function ($item) {
            return $item->pluck('menu_id')->toArray();
        });

        return view('settings.index', compact('roles', 'menus', 'selected'));
    }


    public function create()
    {
        $menus = Menu::all();
        $roles = Role::all();
        return view('settings.create', compact('menus', 'roles'));
    }

    public function store(Request $request)
    {
        SettingMenu::truncate(); // hapus semua pengaturan lama

        foreach ($request->settings ?? [] as $roleId => $menuIds) {
            foreach ($menuIds as $menuId) {
                SettingMenu::create([
                    'role_id' => $roleId,
                    'menu_id' => $menuId,
                ]);
            }
        }

        return redirect()->route('settings.index')->with('success', 'Setting menu berhasil disimpan.');
    }

    public function edit()
    {
        $menus = Menu::all();
        $roles = Role::all();

        // Ambil data yang sudah tersimpan dalam bentuk [role_id => [menu_id, menu_id]]
        $selected = SettingMenu::all()->groupBy('role_id')->map(function ($item) {
            return $item->pluck('menu_id')->toArray();
        });

        return view('settings.edit', compact('menus', 'roles', 'selected'));
    }

    public function update(Request $request)
    {
        SettingMenu::truncate(); // Reset semua dulu

        foreach ($request->settings ?? [] as $roleId => $menuIds) {
            foreach ($menuIds as $menuId) {
                SettingMenu::create([
                    'menu_id' => $menuId,
                    'role_id' => $roleId,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Setting menu berhasil diperbarui.');
    }
}

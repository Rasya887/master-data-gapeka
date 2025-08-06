<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('menu_order')->get();

        return Inertia::render('admin/Menu/Index', [
            'menus' => $menus,
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/Menu/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'menu_order' => 'nullable|numeric',
            'status' => 'required|boolean',
        ]);

        $validated['menu_order'] = $validated['menu_order'] ?? 0;

        Menu::create($validated);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return Inertia::render('admin/Menu/Edit', [
            'menu' => $menu,
        ]);
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'menu_order' => 'nullable|numeric',
            'is_active' => 'required|boolean',
        ]);

        $validated['menu_order'] = $validated['menu_order'] ?? 0;

        $menu->update($validated);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}

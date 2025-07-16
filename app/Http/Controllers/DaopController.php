<?php

namespace App\Http\Controllers;

use App\Models\Daop;
use Illuminate\Http\Request;

class DaopController extends Controller
{
    public function index()
    {
        $daops = Daop::orderBy('id', 'asc')->paginate(10);
        return view('daop.index', compact('daops'));
    }

    public function create()
    {
        return view('daop.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'singkatan' => 'nullable|string|max:20',
            'nomenklatur' => 'nullable|string|max:100',
            'daop' => 'nullable|string|max:100',
            'id_region' => 'nullable|string|max:50',
            'bus_area' => 'nullable|string|max:50',
        ]);

        $data = $request->only(['nama', 'singkatan', 'nomenklatur', 'daop', 'id_region', 'bus_area']);

        Daop::create($data);

        return redirect()->route('daop.index')->with('success', 'Data Daop berhasil ditambahkan');
    }

    public function edit($id)
    {
        $daop = Daop::findOrFail($id);
        return view('daop.edit', compact('daop'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'singkatan' => 'nullable|string|max:20',
            'nomenklatur' => 'nullable|string|max:100',
            'daop' => 'nullable|string|max:100',
            'id_region' => 'nullable|string|max:50',
            'bus_area' => 'nullable|string|max:50',
        ]);

        $daop = Daop::findOrFail($id);
        $data = $request->only(['nama', 'singkatan', 'nomenklatur', 'daop', 'id_region', 'bus_area']);
        $daop->update($data);

        return redirect()->route('daop.index')->with('success', 'Data Daop berhasil diupdate');
    }

    public function destroy($id)
    {
        $daop = Daop::findOrFail($id);
        $daop->delete();

        return redirect()->route('daop.index')->with('success', 'Data Daop berhasil dihapus');
    }

    public function show($id)
    {
        $daop = Daop::findOrFail($id);
        return view('daop.show', compact('daop'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Daop;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DaopController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin|Editor', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    public function index(Request $request)
    {
        $query = Daop::query();

        if ($request->filled('region')) {
            $query->where('id_region', $request->region);
        }

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', "%$keyword%")
                  ->orWhere('singkatan', 'like', "%$keyword%");
            });
        }

        $daops = $query->paginate(10)->appends($request->all());

        return Inertia::render('admin/Daop/Index', [
            'daops' => $daops,
            'filters' => $request->only('search', 'region'),
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/Daop/Create');
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

        Daop::create($request->only([
            'nama', 'singkatan', 'nomenklatur', 'daop', 'id_region', 'bus_area'
        ]));

        return redirect()->route('daops.index')->with('success', 'Data Daop berhasil ditambahkan');
    }

    public function edit($id)
    {
        return Inertia::render('admin/Daop/Edit', [
            'daop' => Daop::findOrFail($id),
        ]);
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
        $daop->update($request->only([
            'nama', 'singkatan', 'nomenklatur', 'daop', 'id_region', 'bus_area'
        ]));

        return redirect()->route('daops.index')->with('success', 'Data Daop berhasil diupdate');
    }

    public function destroy($id)
    {
        $daop = Daop::findOrFail($id);
        $daop->delete();

        return redirect()->route('daops.index')->with('success', 'Data Daop berhasil dihapus');
    }

        public function show($id)
{
    $daop = Daop::findOrFail($id);
    return Inertia::render('admin/Daop/Show', [
        'daop' => $daop
    ]);
}
}

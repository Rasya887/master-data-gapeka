<?php

namespace App\Http\Controllers;

use App\Models\Stasiun;
use App\Models\Daop;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StasiunController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin|Editor', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    public function index(Request $request)
{
    $query = Stasiun::with('daop');

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('singkatan', 'like', '%' . $request->search . '%')
              ->orWhere('kode', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('daop')) {
        $query->where('id_daop', $request->daop);
    }

    if ($request->filled('aktif')) {
        $query->where('aktif', $request->aktif);
    }

    $stasiuns = $query->orderBy('id', 'asc')
        ->paginate(20)
        ->withQueryString();

    $daops = Daop::select('id', 'nama')->get();

    return Inertia::render('admin/Stasiun/Index', [
        'stasiuns' => $stasiuns,
        'daops' => $daops,
        'filters' => [
            'search' => $request->search,
            'daop' => $request->daop,
            'aktif' => $request->aktif,
        ],
    ]);
}

    public function create()
    {
        return Inertia::render('admin/Stasiun/Create', [
            'daops' => Daop::orderBy('nama')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_daop' => 'required|exists:daops,id',
            'singkatan' => 'nullable|string|max:10',
            'nama' => 'required|string|max:100',
            'dpl' => 'nullable|numeric',
            'kode' => 'nullable|string|max:10',
            'aktif' => 'nullable|boolean',
            'kotak' => 'nullable|string|max:100',
            'garis_tipis' => 'nullable|string|max:100',
            'garis_tebal' => 'nullable|string|max:100',
            'perhentian' => 'nullable|string|max:100',
            'batas_daop' => 'nullable|boolean',
            'track' => 'nullable|string|max:100',
            'ppkt' => 'nullable|string|max:100',
        ]);

        Stasiun::create($request->only([
            'id_daop', 'singkatan', 'nama', 'dpl', 'kode', 'aktif', 'kotak',
            'garis_tipis', 'garis_tebal', 'perhentian', 'batas_daop', 'track', 'ppkt'
        ]) + [
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('stasiuns.index')->with('success', 'Data Stasiun berhasil ditambahkan');
    }

    public function edit($id)
    {
        return Inertia::render('admin/Stasiun/Edit', [
            'stasiun' => Stasiun::findOrFail($id),
            'daops' => Daop::orderBy('nama')->get()
        ]);
    }

    public function update(Request $request, $id)
{
    $stasiun = Stasiun::findOrFail($id);

    $validated = $request->validate([
        'id_daop' => 'required|exists:daops,id',
        'singkatan' => 'required|string|max:10',
        'nama' => 'required|string|max:100',
        'dpl' => 'nullable|numeric',
        'kode' => 'nullable|string',
        'aktif' => 'required|boolean',
        'kotak' => 'nullable|string',
        'garis_tipis' => 'nullable|string',
        'garis_tebal' => 'nullable|string',
        'perhentian' => 'nullable|string',
        'batas_daop' => 'nullable|string',
        'track' => 'nullable|string',
        'ppkt' => 'nullable|string',
    ]);

    $validated['updated_by'] = auth()->id();
    $validated['updated_at'] = now(); // manual karena kamu disable timestamps

    $stasiun->update($validated);

    return redirect()->route('stasiuns.index')->with('success', 'Data berhasil diperbarui.');
}


    public function destroy($id)
    {
        $stasiun = Stasiun::findOrFail($id);
        $stasiun->delete();

        return redirect()->route('stasiuns.index')->with('success', 'Data Stasiun berhasil dihapus');
    }

    public function show($id)
{
    $stasiun = Stasiun::with('daop')->findOrFail($id);

    return Inertia::render('admin/Stasiun/Show', [
        'stasiun' => $stasiun
    ]);
}
}

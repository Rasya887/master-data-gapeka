<?php

namespace App\Http\Controllers;

use App\Models\Stasiun;
use App\Models\Daop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class StasiunController extends Controller
{
    
public function index(Request $request)
{
    // Awal query: JOIN ke daops
    $query = Stasiun::join('daops', 'stasiuns.id_daop', '=', 'daops.id')
        ->select('stasiuns.*') // Hindari duplikasi kolom dari join
        ->with('daop');

    // Filter by ID Daop (dropdown)
    if ($request->filled('daop')) {
        $query->where('stasiuns.id_daop', $request->daop);
    }

    // Filter status aktif
    if ($request->filled('aktif')) {
        $query->where('stasiuns.aktif', $request->aktif);
    }

    // Keyword search: cari di nama, singkatan, dan nama daop
    if ($request->filled('search')) {
        $keyword = $request->search;
        $query->where(function ($q) use ($keyword) {
            $q->where('stasiuns.nama', 'like', "%$keyword%")
              ->orWhere('stasiuns.singkatan', 'like', "%$keyword%")
              ->orWhere('daops.nama', 'like', "%$keyword%");
        });
    }

    // Pagination dengan query string tetap terbawa
    $stasiuns = $query->orderBy('stasiuns.nama')->paginate(10)->appends($request->all());

    // Daftar daop buat dropdown filter
    $daops = Daop::all();

    return view('stasiun.index', compact('stasiuns', 'daops'));
}



    public function create()
    {
        $daops = Daop::all();
        return view('stasiun.create', compact('daops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_daop' => 'required|exists:daops,id',
            'singkatan' => 'required|string|max:10',
            'nama' => 'required|string|max:100',
            'dpl' => 'nullable|numeric',
            'kode' => 'nullable|string|max:10',
            'aktif' => 'nullable|boolean',
            'kotak' => 'nullable|boolean',
            'garis_tipis' => 'nullable|boolean',
            'garis_tebal' => 'nullable|boolean',
            'perhentian' => 'nullable|boolean',
            'batas_daop' => 'nullable|boolean',
            'track' => 'nullable|string|max:100',
            'ppkt' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::user()->name ?? 'system';

        Stasiun::create($data);

        return redirect()->route('stasiun.index')->with('success', 'Data stasiun berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $stasiun = Stasiun::findOrFail($id);
        $daops = Daop::all();
        return view('stasiun.edit', compact('stasiun', 'daops'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_daop' => 'required|exists:daops,id',
            'singkatan' => 'required|string|max:10',
            'nama' => 'required|string|max:100',
            'dpl' => 'nullable|numeric',
            'kode' => 'nullable|string|max:10',
            'aktif' => 'nullable|boolean',
            'kotak' => 'nullable|boolean',
            'garis_tipis' => 'nullable|boolean',
            'garis_tebal' => 'nullable|boolean',
            'perhentian' => 'nullable|boolean',
            'batas_daop' => 'nullable|boolean',
            'track' => 'nullable|string|max:100',
            'ppkt' => 'nullable|boolean'
        ]);

        $stasiun = Stasiun::findOrFail($id);
        $data = $request->all();
        $data['updated_by'] = Auth::user()->name ?? 'system';

        $stasiun->update($data);

        return redirect()->route('stasiun.index')->with('success', 'Data stasiun berhasil diupdate.');
    }

    public function destroy($id)
    {
        Stasiun::findOrFail($id)->delete();
        return redirect()->route('stasiun.index')->with('success', 'Data stasiun berhasil dihapus.');
    }
    public function show($id)
{
    $stasiun = Stasiun::findOrFail($id);
    return view('stasiun.show', compact('stasiun'));
}
}

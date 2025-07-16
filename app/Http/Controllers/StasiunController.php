<?php

namespace App\Http\Controllers;

use App\Models\Stasiun;
use App\Models\Daop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StasiunController extends Controller
{
    public function index()
    {
        $stasiuns = Stasiun::with('daop')->paginate(10);
        return view('stasiun.index', compact('stasiuns'));
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

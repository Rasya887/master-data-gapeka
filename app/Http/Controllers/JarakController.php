<?php

namespace App\Http\Controllers;

use App\Models\Jarak;
use App\Models\Daop;
use App\Models\Stasiun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JarakController extends Controller
{
    public function index()
    {
        $jaraks = Jarak::with(['stasiun', 'stasiunSebelah', 'daop'])->paginate(10);
        return view('jarak.index', compact('jaraks'));
    }

    public function create()
    {
        $stasiuns = Stasiun::all();
        $daops = Daop::all();
        return view('jarak.create', compact('stasiuns', 'daops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_daop' => 'required|exists:daops,id',
            'id_stasiun' => 'required|exists:stasiuns,id',
            'id_stasiun_sebelah' => 'required|exists:stasiuns,id',
            'id_lintas' => 'nullable|integer',
            'id_tahun_gapeka' => 'nullable|integer',
            'jarak' => 'required|numeric',
            'puncak_kecepatan' => 'required|integer',
            'taspat' => 'nullable|string',
            'puncak_kecepatan_barang' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::user()->name ?? 'system';

        Jarak::create($data);

        return redirect()->route('jarak.index')->with('success', 'Data jarak berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jarak = Jarak::findOrFail($id);
        $stasiuns = Stasiun::all();
        $daops = Daop::all();
        return view('jarak.edit', compact('jarak', 'stasiuns', 'daops'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_daop' => 'required|exists:daops,id',
            'id_stasiun' => 'required|exists:stasiuns,id',
            'id_stasiun_sebelah' => 'required|exists:stasiuns,id',
            'id_lintas' => 'nullable|integer',
            'id_tahun_gapeka' => 'nullable|integer',
            'jarak' => 'required|numeric',
            'puncak_kecepatan' => 'required|integer',
            'taspat' => 'nullable|string',
            'puncak_kecepatan_barang' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $jarak = Jarak::findOrFail($id);
        $data = $request->all();
        $data['updated_by'] = Auth::user()->name ?? 'system';

        $jarak->update($data);

        return redirect()->route('jarak.index')->with('success', 'Data jarak berhasil diupdate.');
    }

    public function destroy($id)
    {
        $jarak = Jarak::findOrFail($id);
        $jarak->delete();

        return redirect()->route('jarak.index')->with('success', 'Data jarak berhasil dihapus.');
    }
    public function show($id)
{
    $jarak = Jarak::findOrFail($id);
    return view('jarak.show', compact('jarak'));
}
}

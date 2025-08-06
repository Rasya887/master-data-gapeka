<?php

namespace App\Http\Controllers;

use App\Models\Jarak;
use App\Models\Daop;
use App\Models\Stasiun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class JarakController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin|Editor', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    }

    public function index(Request $request)
    {
        $query = Jarak::with(['daop', 'stasiun', 'stasiunSebelah']);

        // Filter pencarian
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->whereHas('stasiun', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%$keyword%")
                      ->orWhere('singkatan', 'like', "%$keyword%");
                })->orWhereHas('stasiunSebelah', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%$keyword%")
                      ->orWhere('singkatan', 'like', "%$keyword%");
                });
            });
        }

        // Filter status
        if ($request->filled('status')) {
    $query->where('status', (int) $request->status);
}

        // Filter berdasarkan Daop
        if ($request->filled('daop')) {
            $query->where('id_daop', $request->daop);
        }

        // Ambil data paginated
        $jaraks = $query->orderBy('id', 'asc')->paginate(20)->withQueryString();

        // Ambil data untuk filter dropdown
        $daops = Daop::select('id', 'nama')->get();
        $stasiuns = Stasiun::select('id', 'nama', 'singkatan')->get();

        // Kirim data ke halaman Vue
        return Inertia::render('admin/Jarak/Index', [
            'jaraks' => $jaraks,
            'daops' => $daops,
            'stasiuns' => $stasiuns,
            'filters' => $request->only('search', 'status', 'daop'),
        ]);
    }

    public function create()
{
    return Inertia::render('admin/Jarak/Create', [
        // Tidak perlu ambil stasiun, daop, dll jika tidak pakai select option
        // Bisa dikosongkan atau tidak dikirim sama sekali
    ]);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'id_daop' => 'required|exists:daops,id',
        'id_stasiun' => 'required|exists:stasiuns,id',
        'id_stasiun_sebelah' => 'required|exists:stasiuns,id',
        'id_lintas' => 'nullable|integer|exists:lintas,id', // jika tabel lintas ada
        'id_tahun_gapeka' => 'nullable|integer',
        'jarak' => 'required|numeric', // ⚠️ sesuaikan field dengan DB
        'puncak_kecepatan' => 'required|integer',
        'taspat' => 'nullable|string|max:100',
        'puncak_kecepatan_barang' => 'nullable|integer',
        'status' => 'required|in:1,0',
    ]);

    $validated['created_by'] = auth()->id();
    $validated['updated_by'] = auth()->id();
    $validated['created_at'] = now();
    $validated['updated_at'] = now();

    Jarak::create($validated);

    return redirect()->route('jarak.index')->with('success', 'Data jarak berhasil ditambahkan.');
}


    public function edit($id)
{
    return Inertia::render('admin/Jarak/Edit', [
        'jarak' => Jarak::with(['daop', 'stasiun', 'stasiunSebelah']) // pastikan tidak ada 'lintas' di sini
            ->findOrFail($id),
        'stasiuns' => Stasiun::all(),
        'daops' => Daop::all(),
        'lintas' => [], // ⛔️ agar tidak error di Vue
        'tahun_gapeka' => [] // kalau dipakai juga
    ]);
}
    public function update(Request $request, Jarak $jarak)
{
    try {
        $validated = $request->validate([
            'id_daop' => 'required|exists:daops,id',
            'id_stasiun' => 'required|exists:stasiuns,id',
            'id_stasiun_sebelah' => 'required|exists:stasiuns,id|different:id_stasiun',
            'id_lintas' => 'nullable|integer',
            'id_tahun_gapeka' => 'nullable|integer',
            'jarak' => 'required|numeric|min:0',
            'puncak_kecepatan' => 'required|numeric|min:0',
            'taspat' => 'nullable|numeric|min:0',
            'puncak_kecepatan_barang' => 'nullable|numeric|min:0',
            'status' => 'required|in:0,1',
        ]);

        $jarak->update([
            'id_daop' => $validated['id_daop'],
            'id_stasiun' => $validated['id_stasiun'],
            'id_stasiun_sebelah' => $validated['id_stasiun_sebelah'],
            'id_lintas' => $validated['id_lintas'],
            'id_tahun_gapeka' => $validated['id_tahun_gapeka'],
            'jarak' => $validated['jarak'],
            'puncak_kecepatan' => $validated['puncak_kecepatan'],
            'taspat' => $validated['taspat'],
            'puncak_kecepatan_barang' => $validated['puncak_kecepatan_barang'],
            'status' => $validated['status'],
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('jarak.index')->with('success', 'Data jarak berhasil diperbarui.');
    } catch (\Exception $e) {
    dd($e->getMessage()); // ← sementara tampilkan error asli
    Log::error('Gagal update Jarak: ' . $e->getMessage());
    return back()->withErrors(['update_error' => 'Gagal menyimpan perubahan. Silakan cek kembali input.']);
}
}

    public function destroy($id)
    {
        $jarak = Jarak::findOrFail($id);
        $jarak->delete();

        return redirect()->route('jarak.index')->with('success', 'Data jarak berhasil dihapus.');
    }

    public function show($id)
    {
        $jarak = Jarak::with(['daop', 'stasiun', 'stasiunSebelah'])->findOrFail($id);

        return Inertia::render('admin/Jarak/Show', [
            'jarak' => $jarak
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Daop;
use App\Models\Stasiun;
use App\Models\Jarak;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\GenericExport;

class ExportController extends Controller
{
    // === DAOP ===
    public function exportDaopExcel()
    {
        $data = Daop::select('nama', 'singkatan', 'nomenklatur', 'daop', 'id_region', 'bus_area')->get();
        $data->transform(function ($item) {
            $item->id_region = $item->id_region == 1 ? 'Jawa' : ($item->id_region == 2 ? 'Sumatera' : '-');
            return $item;
        });

        $headings = ['Nama', 'Singkatan', 'Nomenklatur', 'Daop', 'Region', 'Bus Area'];
        return Excel::download(new GenericExport($data, $headings), 'daop.xlsx');
    }

    public function exportDaopPdf()
    {
        $data = Daop::select('nama', 'singkatan', 'nomenklatur', 'daop', 'id_region', 'bus_area')->get();
        $data->transform(function ($item) {
            $item->id_region = $item->id_region == 1 ? 'Jawa' : ($item->id_region == 2 ? 'Sumatera' : '-');
            return $item;
        });
        $pdf = Pdf::loadView('exports.daop', compact('data'));
        return $pdf->download('daop.pdf');
    }

    // === STASIUN ===
    public function exportStasiunExcel()
{
    $data = Stasiun::with('daop')->get()->map(function ($stasiun) {
        return [
            'Daop' => $stasiun->daop->nama ?? '-',
            'Singkatan' => $stasiun->singkatan,
            'Nama' => $stasiun->nama,
            'DPL' => $stasiun->dpl,
            'Kode' => $stasiun->kode,
            'Status' => $stasiun->aktif,
            'Kotak' => $stasiun->kotak,
            'Garis Tipis' => $stasiun->garis_tipis,
            'Garis Tebal' => $stasiun->garis_tebal,
            'Perhentian' => $stasiun->perhentian,
            'Batas Daop' => $stasiun->batas_daop,
            'Created At' => $stasiun->created_at,
            'Updated At' => $stasiun->updated_at,
            'Created By' => $stasiun->created_by,
            'Updated By' => $stasiun->updated_by,
            'Track' => $stasiun->track,
            'PPKT' => $stasiun->ppkt,
        ];
    });

    $headings = [
        'Daop',
        'Singkatan',
        'Nama',
        'DPL',
        'Kode',
        'Status',
        'Kotak',
        'Garis Tipis',
        'Garis Tebal',
        'Perhentian',
        'Batas Daop',
        'Created At',
        'Updated At',
        'Created By',
        'Updated By',
        'Track',
        'PPKT',
    ];

    return Excel::download(new GenericExport($data, $headings), 'stasiun.xlsx');
}

    public function exportStasiunPdf()
{
    $data = Stasiun::select(
            'daops.nama as daop',
            'stasiuns.singkatan',
            'stasiuns.nama',
            'stasiuns.dpl',
            'stasiuns.kode',
            'stasiuns.aktif as status',
            'stasiuns.kotak',
            'stasiuns.garis_tipis',
            'stasiuns.garis_tebal',
            'stasiuns.perhentian',
            'stasiuns.batas_daop',
            'stasiuns.created_at',
            'stasiuns.updated_at',
            'stasiuns.created_by',
            'stasiuns.updated_by',
            'stasiuns.track',
            'stasiuns.ppkt'
        )
        ->join('daops', 'stasiuns.id_daop', '=', 'daops.id')
        ->limit(500)
        ->get();

    $pdf = Pdf::loadView('exports.stasiun', compact('data'));
    return $pdf->download('stasiun.pdf');
}


    // === JARAK ===
    public function exportJarakExcel()
{
    $data = Jarak::query()
    ->join('daops', 'jarak.id_daop', '=', 'daops.id')
    ->join('stasiuns as s1', 'jarak.id_stasiun', '=', 's1.id')
    ->join('stasiuns as s2', 'jarak.id_stasiun_sebelah', '=', 's2.id')
    ->select(
        'daops.nama as Daop',
        's1.nama as Stasiun',
        's2.nama as Stasiun_Sebelah',
        'id_lintas as Lintas', // langsung ambil dari tabel jaraks
        'id_tahun_gapeka as Tahun_Gapeka',
        'jarak as Jarak_km',
        'jarak.puncak_kecepatan as Puncak_Kecepatan',
        'jarak.taspat as Taspat',
        'jarak.puncak_kecepatan_barang as Kec_Barang',
        'jarak.status as Status',
        'jarak.created_at as Created_At',
        'jarak.created_by as Created_By',
        'jarak.updated_at as Updated_At',
        'jarak.updated_by as Updated_By',
        'jarak.approved_at as Approved_At',
        'jarak.approved_by as Approved_By'
    )
    ->limit(500)
    ->get();


    $headings = [
        'Daop', 'Stasiun', 'Stasiun Sebelah', 'Lintas', 'Tahun Gapeka', 'Jarak (km)',
        'Puncak Kecepatan', 'Taspat', 'Kec. Barang', 'Status',
        'Created At', 'Created By', 'Updated At', 'Updated By', 'Approved At', 'Approved By'
    ];

    return Excel::download(new GenericExport($data, $headings), 'jarak.xlsx');
}

public function exportJarakPdf()
{
    ini_set('memory_limit', '1024M');
    set_time_limit(120);

    $data = Jarak::query()
        ->join('daops', 'jarak.id_daop', '=', 'daops.id')
        ->join('stasiuns as s1', 'jarak.id_stasiun', '=', 's1.id')
        ->join('stasiuns as s2', 'jarak.id_stasiun_sebelah', '=', 's2.id')
        ->select(
            'daops.nama as Daop',
            's1.nama as Stasiun',
            's2.nama as Stasiun_Sebelah',
            'jarak.id_lintas as Lintas',
            'jarak.id_tahun_gapeka as Tahun_Gapeka',
            'jarak.jarak as Jarak_km',
            'jarak.puncak_kecepatan as Puncak_Kecepatan',
            'jarak.taspat as Taspat',
            'jarak.puncak_kecepatan_barang as Kec_Barang',
            'jarak.status as Status',
            'jarak.created_at as Created_At',
            'jarak.created_by as Created_By',
            'jarak.updated_at as Updated_At',
            'jarak.updated_by as Updated_By',
            'jarak.approved_at as Approved_At',
            'jarak.approved_by as Approved_By'
        )
        ->limit(200) // kurangi dulu
        ->get();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::setPaper('a4', 'landscape')
        ->loadView('exports.jarak', ['data' => $data]);

    return $pdf->download('jarak.pdf');
}

}
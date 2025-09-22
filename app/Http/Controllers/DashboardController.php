<?php

namespace App\Http\Controllers;

use App\Models\Stasiun;
use App\Models\Jarak;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Stasiun & Jarak
        $totalStasiun = Stasiun::count();
        $totalJarak   = Jarak::count();

        // Statistik Stasiun per Daop
        $stasiunPerDaop = Stasiun::select('id_daop', DB::raw('COUNT(*) as total'))
            ->groupBy('id_daop')
            ->get()
            ->map(fn($item) => [
                'id_daop' => 'Daop ' . $item->id_daop,
                'total'   => (int) $item->total,
            ])
            ->toArray();

        // Statistik Jarak per Daop
        $jarakPerDaop = Jarak::select('id_daop', DB::raw('COUNT(*) as total'))
            ->groupBy('id_daop')
            ->get()
            ->map(fn($item) => [
                'id_daop' => 'Daop ' . $item->id_daop,
                'total'   => (int) $item->total,
            ])
            ->toArray();

        return Inertia::render('Dashboard', [
            'totalStasiun'    => $totalStasiun,
            'totalJarak'      => $totalJarak,
            'stasiunPerDaop'  => $stasiunPerDaop,
            'jarakPerDaop'    => $jarakPerDaop,
        ]);
    }
}

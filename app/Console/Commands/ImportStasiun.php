<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StasiunImport;

class ImportStasiun extends Command
{
    protected $signature = 'import:stasiun';
    protected $description = 'Import data stasiun dari file Excel';

    public function handle()
    {
        $path = storage_path('app/public/stasiun.xlsx');

        if (!file_exists($path)) {
            $this->error('File Excel tidak ditemukan di: storage/app/public/import/stasiun.xlsx');
            return;
        }

        Excel::import(new StasiunImport, $path);

        $this->info('Data stasiun berhasil diimport!');
    }
}

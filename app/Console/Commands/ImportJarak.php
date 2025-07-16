<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JarakImport;

class ImportJarak extends Command
{
    protected $signature = 'import:jarak';
    protected $description = 'Import data jarak dari file Excel';

    public function handle()
    {
        $filePath = storage_path('app/public/data_jarak.xlsx'); // pastikan file ini ada!
        
        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan di: $filePath");
            return;
        }

        Excel::import(new JarakImport, $filePath);
        $this->info('Data jarak berhasil diimport!');
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DaopImport;

class ImportDaop extends Command
{
    protected $signature = 'import:daop';
    protected $description = 'Import data Daop dari file Excel';

    public function handle()
    {
        $filePath = storage_path('app/public//data_daop.xlsx');

        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan di: storage/app/public/import/daop.xlsx");
            return 1;
        }

        Excel::import(new DaopImport, $filePath);

        $this->info('Data Daop berhasil diimport!');
        return 0;
    }
}

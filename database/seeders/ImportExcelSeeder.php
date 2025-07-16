<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DaopImport;
use App\Imports\StasiunImport;
use App\Imports\JarakImport;

class ImportExcelSeeder extends Seeder
{
    public function run(): void
    {
        Excel::import(new DaopImport, 'public/excel/daop.xlsx');
        Excel::import(new StasiunImport, 'public/excel/stasiun.xlsx');
        Excel::import(new JarakImport, 'public/excel/jarak.xlsx');
    }
}

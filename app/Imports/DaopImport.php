<?php

namespace App\Imports;

use App\Models\Daop;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DaopImport implements ToModel, WithHeadingRow
{
    public function formDaop()
    {
        return view('import.daop');
    }

    public function model(array $row)
    {
        return new Daop([
            'nama'         => $row['nama'],
            'singkatan'    => $row['singkatan'],
            'nomenklatur'  => $row['nomenklatur'],
            'daop'         => $row['daop'],
            'id_region'    => $row['id_region'],
            'bus_area'     => $row['bus_area'],
        ]);
    }

    private function parseDate($value)
    {
        if (empty($value)) return null;

        try {
            if (is_numeric($value)) {
                return Date::excelToDateTimeObject($value); // dari serial Excel
            }
            return date('Y-m-d H:i:s', strtotime($value)); // dari string biasa
        } catch (\Exception $e) {
            return null;
        }
    }
}

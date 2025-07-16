<?php

namespace App\Imports;

use App\Models\Stasiun;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;

class StasiunImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Stasiun::create([
                'id_daop'       => $row['id_daop'],
                'singkatan'     => $row['singkatan'],
                'nama'          => $row['nama'],
                'dpl'           => $row['dpl'],
                'kode'          => $row['kode'],
                'aktif'         => $row['aktif'],
                'kotak'         => $row['kotak'],
                'garis_tipis'   => $row['garis_tipis'],
                'garis_tebal'   => $row['garis_tebal'],
                'perhentian'    => $row['perhentian'],
                'batas_daop'    => $row['batas_daop'],
                'created_at'    => $this->parseDate($row['created_at']),
                'updated_at'    => $this->parseDate($row['updated_at']),
                'created_by'    => $row['created_by'],
                'updated_by'    => $row['updated_by'],
                'track'         => $row['track'],
                'ppkt'          => $row['ppkt'],
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 500;
    }

    private function parseDate($value)
    {
        if (empty($value)) return null;

        try {
            if (is_numeric($value)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
            } elseif (strtotime($value)) {
                return date('Y-m-d H:i:s', strtotime($value));
            }
        } catch (\Exception $e) {
            return null;
        }

        return null;
    }
}

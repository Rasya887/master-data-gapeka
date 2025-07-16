<?php

namespace App\Imports;

use App\Models\Jarak;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;

class JarakImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Jarak::create([
                'id_daop'                  => $row['id_daop'],
                'id_stasiun'              => $row['id_stasiun'],
                'id_stasiun_sebelah'      => $row['id_stasiun_sebelah'],
                'id_lintas'               => $row['id_lintas'],
                'id_tahun_gapeka'         => $row['id_tahun_gapeka'],
                'jarak'                   => $row['jarak'],
                'puncak_kecepatan'        => $row['puncak_kecepatan'],
                'taspat'                  => $row['taspat'],
                'puncak_kecepatan_barang' => $row['puncak_kecepatan_barang'],
                'status'                  => $row['status'],
                'created_by'              => $row['created_by'],
                'created_at'              => $this->parseDate($row['created_at']),
                'updated_by'              => $row['updated_by'],
                'updated_at'              => $this->parseDate($row['updated_at']),
                'approved_by'             => $row['approved_by'],
                'approved_at'             => $this->parseDate($row['approved_at']),
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 500;
    }

    private function parseDate($value)
{
    if (empty($value)) {
        return null;
    }

    try {
        if (is_numeric($value)) {
            // Format Excel serial number
            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
            $formatted = $date->format('Y-m-d H:i:s');

            // Cek jika hasil konversi tidak valid
            if ($formatted === '1970-01-01 00:00:00' || $formatted === '-0001-11-30 00:00:00') {
                return null;
            }

            return $formatted;
        } elseif (strtotime($value)) {
            $parsed = Carbon::parse($value)->format('Y-m-d H:i:s');

            // Cek lagi hasil parsing
            if ($parsed === '1970-01-01 00:00:00' || $parsed === '-0001-11-30 00:00:00') {
                return null;
            }

            return $parsed;
        }
    } catch (\Exception $e) {
        return null;
    }

    return null;
}
}

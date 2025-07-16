<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\JarakImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DaopImport;

class ImportController extends Controller
{
    public function showForm()
    {
        return view('import.jarak');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new JarakImport, $request->file('file'));

        return back()->with('success', 'Data Jarak berhasil diimpor!');
    }
    public function formDaop()
{
    return view('import.daop'); // pastikan file blade-nya sesuai
}

public function importDaop(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls',
    ]);

    Excel::import(new DaopImport, $request->file('file'));

    return redirect()->back()->with('success', 'Data Daop berhasil diimport!');
}
}

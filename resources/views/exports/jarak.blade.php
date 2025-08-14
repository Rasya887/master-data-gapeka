<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export Jarak</title>
    <style>
        * { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; }
        h2 { margin: 0 0 12px 0; }
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }
        th, td { border: 1px solid #000; padding: 6px 8px; font-size: 12px; word-wrap: break-word; }
        thead th { background: #f2f2f2; }
        /* garis zebra tipis biar enak dibaca */
        tbody tr:nth-child(even) td { background: #fafafa; }
    </style>
</head>
<body>
    <h2>Data Jarak</h2>

    @if($data->isEmpty())
        <p><em>Tidak ada data.</em></p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Daop</th>
                    <th>Stasiun</th>
                    <th>Stasiun Sebelah</th>
                    <th>Lintas</th>
                    <th>Tahun Gapeka</th>
                    <th>Jarak (km)</th>
                    <th>Puncak Kecepatan</th>
                    <th>Taspat</th>
                    <th>Kec. Barang</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Created By</th>
                    <th>Updated At</th>
                    <th>Updated By</th>
                    <th>Approved At</th>
                    <th>Approved By</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{ $row->Daop }}</td>
                        <td>{{ $row->Stasiun }}</td>
                        <td>{{ $row->Stasiun_Sebelah }}</td>
                        <td>{{ $row->Lintas }}</td>
                        <td>{{ $row->Tahun_Gapeka }}</td>
                        <td>{{ $row->Jarak_km }}</td>
                        <td>{{ $row->Puncak_Kecepatan }}</td>
                        <td>{{ $row->Taspat }}</td>
                        <td>{{ $row->Kec_Barang }}</td>
                        <td>{{ $row->Status }}</td>
                        <td>{{ $row->Created_At }}</td>
                        <td>{{ $row->Created_By }}</td>
                        <td>{{ $row->Updated_At }}</td>
                        <td>{{ $row->Updated_By }}</td>
                        <td>{{ $row->Approved_At }}</td>
                        <td>{{ $row->Approved_By }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export Daop</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { margin: 0; text-align: center; }
    </style>
</head>
<body>
    <h2>Data Daop</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Singkatan</th>
                <th>Nomenklatur</th>
                <th>Daop</th>
                <th>Region</th>
                <th>Bus Area</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $daop)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $daop->nama }}</td>
                    <td>{{ $daop->singkatan }}</td>
                    <td>{{ $daop->nomenklatur ?? '-' }}</td>
                    <td>{{ $daop->daop ?? '-' }}</td>
                    <td>{{ $daop->id_region == 1 ? 'Jawa' : ($daop->id_region == 2 ? 'Sumatera' : '-') }}</td>
                    <td>{{ $daop->bus_area ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

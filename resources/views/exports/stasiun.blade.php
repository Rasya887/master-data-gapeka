<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Export Stasiun</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Data Stasiun</h2>

    @php
        $firstRow = $data->first() ? $data->first()->toArray() : [];
    @endphp

    <table>
        <thead>
            <tr>
                @foreach(array_keys($firstRow) as $header)
                    <th>{{ ucfirst(str_replace('_', ' ', $header)) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                @php
                    $rowArray = is_array($row) ? $row : $row->toArray();
                @endphp
                <tr>
                    @foreach($rowArray as $value)
                        <td>{{ is_scalar($value) ? $value : json_encode($value) }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

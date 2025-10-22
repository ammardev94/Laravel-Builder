<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Family Services Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .small {
            font-size: 11px;
        }
    </style>
</head>
<body>

    <h2>Family Services Report</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Family Name</th>
                <th>Service</th>
                <th>Date</th>
                <th>Created On</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($familyServices as $index => $fs)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $fs->family->father_name ?? '-' }}</td>
                    <td>{{ $fs->service }}</td>
                    <td>{{ \Carbon\Carbon::parse($fs->date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($fs->created_at)->format('d M Y h:i A') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

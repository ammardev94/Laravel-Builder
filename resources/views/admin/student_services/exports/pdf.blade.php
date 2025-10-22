<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Services PDF</title>
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
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>
<body>

    <h2>Student Services Report</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Service</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($studentServices as $index => $service)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $service->student->stu_full_name ?? 'N/A' }}</td>
                    <td>{{ $service->service }}</td>
                    <td>{{ \Carbon\Carbon::parse($service->date)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VTC Students Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table, th, td {
            border: 1px solid #666;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        th, td {
            padding: 6px 8px;
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
        .img-thumbnail {
            width: 50px;
            height: auto;
        }
    </style>
</head>
<body>

    <h2>VTC Students Report</h2>

    <table>
        <thead>
            <tr>
                <th></th>
                <th>GR No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact No</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vtcStudents as $index => $student)
                <tr>
                    <td class="text-center">
                        @if($student->img)
                            <img src="{{ public_path('storage/' . $student->img) }}" alt="Profile" class="img-thumbnail">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $student->gr_no }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email ?? 'N/A' }}</td>
                    <td>{{ $student->contact_no ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="17" class="text-center">No student records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="text-center">Generated on {{ \Carbon\Carbon::now()->format('d M Y h:i A') }}</p>

</body>
</html>

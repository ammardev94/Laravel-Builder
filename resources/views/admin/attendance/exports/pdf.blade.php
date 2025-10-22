<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Attendance Records</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #666;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #efefef;
        }
        h2 {
            margin: 0 0 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Attendance Records</h2>

    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Class</th>
                <th>Date</th>
                <th>Attendance</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->student->stu_full_name ?? 'N/A' }}</td>
                    <td>{{ $attendance->class }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                    <td>{{ ucfirst($attendance->attendance) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No attendance records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

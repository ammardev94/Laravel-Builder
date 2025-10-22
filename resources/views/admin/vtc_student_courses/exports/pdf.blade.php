<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>VTC Student Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>VTC Student Courses</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Student Name</th>
            <th>Course Name</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @forelse($vtcStudentCourses as $index => $record)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $record->student?->name ?? 'N/A' }}</td>
                <td>{{ $record->course?->name ?? 'N/A' }}</td>
                <td>{{ $record->created_at ? \Carbon\Carbon::parse($record->created_at)->format('d M Y') : 'N/A' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align:center;">No records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>

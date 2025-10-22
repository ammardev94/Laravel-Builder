<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>VTC Student Academic Records</title>
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
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>VTC Student Academic Records</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Institution Name</th>
                <th>Qualification</th>
                <th>Year</th>
            </tr>
        </thead>
        <tbody>
            @forelse($academicRecords as $record)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $record->student->name ?? '' }}</td>
                    <td>{{ $record->institute_name }}</td>
                    <td>{{ $record->qualification }}</td>
                    <td>{{ $record->year }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Health Records PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table th, table td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>

    <h2>Health Records</h2>

    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Family</th>
                <th>Checkup Date</th>
                <th>Pulse</th>
                <th>BP</th>
                <th>Height (cm)</th>
                <th>Weight (kg)</th>
                <th>BMI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($healthRecords as $record)
                <tr>
                    <td>{{ $record->student->stu_full_name ?? 'N/A' }}</td>
                    <td>{{ $record->family->father_name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->checkup_date)->format('d M Y') }}</td>
                    <td>{{ $record->pulse }}</td>
                    <td>{{ $record->bp }}</td>
                    <td>{{ $record->height_cm }}</td>
                    <td>{{ $record->weight }}</td>
                    <td>{{ $record->bmi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

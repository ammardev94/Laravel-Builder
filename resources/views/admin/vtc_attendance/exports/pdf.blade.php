<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>VTC Attendance Report</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 18px;
            text-transform: uppercase;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }

        .report-meta {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th, td {
            border: 1px solid #666;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            text-transform: uppercase;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>
<body>
    <h2>VTC Attendance Report</h2>

    <div class="report-meta">
        @if(request('date'))
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse(request('date'))->format('d M Y') }}</p>
        @endif
        @if(request('vtc_student_id'))
            <p><strong>Student:</strong> {{ optional($attendances->first()->vtcStudent)->name ?? 'N/A' }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>GR No</th>
                <th>Student Name</th>
                <th>Attendance</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $index => $attendance)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $attendance->gr_no }}</td>
                    <td>{{ $attendance->vtcStudent->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst($attendance->attendence) }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No attendance records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Generated on {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}</p>
    </div>
</body>
</html>

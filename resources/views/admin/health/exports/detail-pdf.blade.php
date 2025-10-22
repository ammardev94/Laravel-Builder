<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Health Record - {{ $health->student->stu_full_name ?? 'Unknown Student' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
            width: 30%;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
            color: #777;
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 10px;
            border-radius: 5px;
            margin: 2px;
        }
        .badge-secondary {
            background-color: #6c757d;
            color: #fff;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Health Record Details</h2>

    <table class="table">
        <tbody>
            <tr><th>Checkup Date</th><td>{{ $health->checkup_date ?? 'N/A' }}</td></tr>
            <tr><th>Pulse</th><td>{{ $health->pulse ?? 'N/A' }}</td></tr>
            <tr><th>Body Temperature</th><td>{{ $health->body_temp ?? 'N/A' }}</td></tr>
            <tr><th>Respiration</th><td>{{ $health->respiration ?? 'N/A' }}</td></tr>
            <tr><th>Blood Pressure</th><td>{{ $health->bp ?? 'N/A' }}</td></tr>
            <tr><th>Height (cm)</th><td>{{ $health->height_cm ?? 'N/A' }}</td></tr>
            <tr><th>Weight</th><td>{{ $health->weight ?? 'N/A' }}</td></tr>
            <tr><th>BMI</th><td>{{ $health->bmi ?? 'N/A' }}</td></tr>
            <tr><th>BMI Percentile</th><td>{{ $health->bmi_percentile ?? 'N/A' }}</td></tr>
            <tr><th>Eye (Left)</th><td>{{ $health->eye_left ?? 'N/A' }}</td></tr>
            <tr><th>Eye (Right)</th><td>{{ $health->eye_right ?? 'N/A' }}</td></tr>
            <tr><th>Pallor</th><td>{{ $health->pallor ?? 'N/A' }}</td></tr>
            <tr><th>Lice</th><td>{{ $health->lice ?? 'N/A' }}</td></tr>
            <tr><th>Consciousness</th><td>{{ $health->consciousness ?? 'N/A' }}</td></tr>
            <tr><th>Diet</th><td>{{ $health->diet ?? 'N/A' }}</td></tr>
            <tr><th>Teeth</th><td>{{ $health->teeth ?? 'N/A' }}</td></tr>
            <tr><th>History</th><td>{{ $health->history ?? 'N/A' }}</td></tr>
            <tr><th>Diagnosis</th><td>{{ $health->diagnosis ?? 'N/A' }}</td></tr>
            <tr><th>Management</th><td>{{ $health->management ?? 'N/A' }}</td></tr>
            <tr><th>Advice</th><td>{{ $health->advice ?? 'N/A' }}</td></tr>
            <tr><th>Refer</th><td>{{ $health->refer ?? 'N/A' }}</td></tr>
            <tr><th>Follow-up</th><td>{{ $health->followup ?? 'N/A' }}</td></tr>
            <tr><th>Session</th><td>{{ $health->session ?? 'N/A' }}</td></tr>
            <tr><th>Created On</th><td>{{ $health->created_on ?? 'N/A' }}</td></tr>
            <tr><th>Updated On</th><td>{{ $health->updated_on ?? 'N/A' }}</td></tr>
        </tbody>
    </table>

    <h4>Associated Student</h4>
    @if($health->student)
        <span class="badge badge-secondary">
            {{ $health->student->stu_full_name ?? 'N/A' }} (GR No: {{ $health->student->gr_num ?? 'N/A' }})
        </span>
    @else
        <span class="badge badge-secondary">No student record found.</span>
    @endif

    <h4 style="margin-top:15px;">Associated Family</h4>
    @if($health->family)
        <span class="badge badge-secondary">
            {{ $health->family->father_name ?? 'N/A' }} ({{ $health->family->father_cnic ?? 'N/A' }})
        </span>
    @else
        <span class="badge badge-secondary">No family record found.</span>
    @endif

    <div class="footer">
        Generated on: {{ now()->format('d-m-Y h:i A') }}
    </div>
</body>
</html>

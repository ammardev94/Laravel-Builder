<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Service - {{ $studentService->service ?? 'Unknown' }}</title>
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
        .badge-danger {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Student Service Details</h2>

    <table class="table">
        <tbody>
            <tr><th>Service</th><td>{{ $studentService->service ?? 'N/A' }}</td></tr>
            <tr><th>Date</th><td>{{ $studentService->date ?? 'N/A' }}</td></tr>
            <tr><th>Created On</th><td>{{ $studentService->created_on ?? 'N/A' }}</td></tr>
            <tr><th>Updated On</th><td>{{ $studentService->updated_on ?? 'N/A' }}</td></tr>
        </tbody>
    </table>

    <h4>Student</h4>
    @if($studentService->student)
        <span class="badge badge-secondary">
            {{ $studentService->student->stu_full_name ?? 'N/A' }} (GR No: {{ $studentService->student->gr_num ?? 'N/A' }})
        </span>
    @else
        <span class="badge badge-danger">No student record found.</span>
    @endif

    <div class="footer">
        Generated on: {{ now()->format('d-m-Y h:i A') }}
    </div>
</body>
</html>

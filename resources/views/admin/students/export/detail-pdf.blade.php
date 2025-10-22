<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student - {{ $student->stu_full_name ?? 'Unknown' }}</title>
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
    <h2 style="text-align:center;">Student Details</h2>

    <table class="table">
        <tbody>
            <tr><th>Full Name</th><td>{{ $student->stu_full_name ?? 'N/A' }}</td></tr>
            <tr><th>GR No</th><td>{{ $student->gr_num ?? 'N/A' }}</td></tr>
            <tr><th>Auto GR No</th><td>{{ $student->auto_gr_num ?? 'N/A' }}</td></tr>
            <tr><th>Date of Birth</th><td>{{ $student->stu_dob ?? 'N/A' }}</td></tr>
            <tr><th>Gender</th><td>{{ ucfirst($student->stu_gender ?? 'N/A') }}</td></tr>
            <tr><th>Class</th><td>{{ $student->class ?? 'N/A' }}</td></tr>
            <tr><th>Donation Date</th><td>{{ $student->donation_date ?? 'N/A' }}</td></tr>
            <tr><th>Donation Expiry</th><td>{{ $student->donation_expiry ?? 'N/A' }}</td></tr>
            <tr><th>Created On</th><td>{{ $student->created_on ?? 'N/A' }}</td></tr>
            <tr><th>Updated On</th><td>{{ $student->updated_on ?? 'N/A' }}</td></tr>
        </tbody>
    </table>

    <h4>Family</h4>
    @if($student->family)
        <table class="table">
            <tbody>
                <tr><th>Father Name</th><td>{{ $student->family->father_name ?? 'N/A' }}</td></tr>
                <tr><th>Mother Name</th><td>{{ $student->family->mother_name ?? 'N/A' }}</td></tr>
                <tr><th>Address</th><td>{{ $student->family->address ?? 'N/A' }}</td></tr>
                <tr><th>Religion</th><td>{{ $student->family->religion ?? 'N/A' }}</td></tr>
            </tbody>
        </table>
    @else
        <span class="badge badge-secondary">No family record found.</span>
    @endif

    <h4>Donor</h4>
    @if($student->donor)
        <table class="table">
            <tbody>
                <tr><th>Name</th><td>{{ $student->donor->donor_name ?? 'N/A' }}</td></tr>
                <tr><th>WhatsApp</th><td>{{ $student->donor->donor_whatsapp ?? 'N/A' }}</td></tr>
            </tbody>
        </table>
    @else
        <span class="badge badge-secondary">No donor record found.</span>
    @endif

    <h4 style="margin-top:15px;">Health Records</h4>
    @if(!empty($student->healthRecords) && $student->healthRecords->count())
        <ul>
            @foreach($student->healthRecords as $record)
                <li>{{ $record->diagnosis ?? 'N/A' }}</li>
            @endforeach
        </ul>
    @else
        <span class="badge badge-secondary">No health records found.</span>
    @endif

    <h4 style="margin-top:15px;">Student Services</h4>
    @if(!empty($student->studentServices) && $student->studentServices->count())
        <ul>
            @foreach($student->studentServices as $service)
                <li>({{ $service->date ?? 'N/A' }}) - {{ $service->service ?? 'N/A' }}</li>
            @endforeach
        </ul>
    @else
        <span class="badge badge-secondary">No services found.</span>
    @endif

    <h4 style="margin-top:15px;">Attendance Records</h4>
    @if(!empty($student->attendances) && $student->attendances->count())
        <ul>
            @foreach($student->attendances as $attendance)
                <li>({{ $attendance->date ?? 'N/A' }}) - {{ $attendance->class ?? 'N/A' }} - {{ ucfirst($attendance->attendance) ?? 'N/A' }}</li>
            @endforeach
        </ul>
    @else
        <span class="badge badge-secondary">No attendance records found.</span>
    @endif

    <div class="footer">
        Generated on: {{ now()->format('d-m-Y h:i A') }}
    </div>
</body>
</html>

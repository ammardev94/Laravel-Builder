<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Family - {{ $family->father_name ?? 'Unknown' }}</title>
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
    <h2 style="text-align:center;">Family Details</h2>

    <table class="table">
        <tbody>
            <tr><th>Father Name</th><td>{{ $family->father_name ?? 'N/A' }}</td></tr>
            <tr><th>Father CNIC</th><td>{{ $family->father_cnic ?? 'N/A' }}</td></tr>
            <tr><th>Father Occupation</th><td>{{ $family->father_occup ?? 'N/A' }}</td></tr>
            <tr><th>Father Phone</th><td>{{ $family->father_phone ?? 'N/A' }}</td></tr>
            <tr><th>Mother Name</th><td>{{ $family->mother_name ?? 'N/A' }}</td></tr>
            <tr><th>Mother CNIC</th><td>{{ $family->mother_cnic ?? 'N/A' }}</td></tr>
            <tr><th>Mother Occupation</th><td>{{ $family->mother_occup ?? 'N/A' }}</td></tr>
            <tr><th>Children Count</th><td>{{ $family->children_count ?? 'N/A' }}</td></tr>
            <tr><th>Address</th><td>{{ $family->address ?? 'N/A' }}</td></tr>
            <tr><th>Religion</th><td>{{ $family->religion ?? 'N/A' }}</td></tr>
            <tr><th>Zakat</th><td>{{ $family->zakat ? 'Yes' : 'No' }}</td></tr>
            <tr><th>Emergency Contact Name</th><td>{{ $family->emerg_name ?? 'N/A' }}</td></tr>
            <tr><th>Emergency Relation</th><td>{{ $family->emerg_relation ?? 'N/A' }}</td></tr>
            <tr><th>Emergency Number</th><td>{{ $family->emerg_num ?? 'N/A' }}</td></tr>
            <tr><th>Created On</th><td>{{ $family->created_on ?? 'N/A' }}</td></tr>
            <tr><th>Updated On</th><td>{{ $family->updated_on ?? 'N/A' }}</td></tr>
        </tbody>
    </table>

    <h4>Students</h4>
    @if(!empty($family->students) && $family->students->count())
        @foreach($family->students as $student)
            <span class="badge badge-secondary">
                {{ $student->stu_full_name ?? 'N/A' }} ({{ $student->gr_num ?? 'N/A' }})
            </span>
        @endforeach
    @else
        <span class="badge badge-secondary">No records found.</span>
    @endif

    <h4 style="margin-top:15px;">Health Records</h4>
    @if(!empty($family->healthRecords) && $family->healthRecords->count())
        <ul>
            @foreach($family->healthRecords as $record)
                <li>{{ $record->diagnosis ?? 'N/A' }}</li>
            @endforeach
        </ul>
    @else
        <span class="badge badge-secondary">No records found.</span>
    @endif

    <h4 style="margin-top:15px;">Family Services</h4>
    @if(!empty($family->familyServices) && $family->familyServices->count())
        <ul>
            @foreach($family->familyServices as $service)
                <li>{{ $service->service ?? 'N/A' }}</li>
            @endforeach
        </ul>
    @else
        <span class="badge badge-secondary">No records found.</span>
    @endif

    <div class="footer">
        Generated on: {{ now()->format('d-m-Y h:i A') }}
    </div>
</body>
</html>

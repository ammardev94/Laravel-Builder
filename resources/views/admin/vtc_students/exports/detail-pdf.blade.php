<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>VTC Student - {{ $student->name ?? 'Unknown' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
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
    <div class="text-center" style="text-align:center; margin-bottom:20px;">
        @php
            $profilePath = $student->img 
                ? public_path('storage/'.$student->img) 
                : public_path('adminlte/images/llcf-white-header.png');
        @endphp
        @if(file_exists($profilePath))
            <img src="{{ $profilePath }}" class="profile-img" alt="Student Image">
        @else
            <img src="{{ public_path('adminlte/images/llcf-white-header.png') }}" class="profile-img" alt="Default Image">
        @endif
    </div>

    <table class="table">
        <tbody>
            <tr>
                <th>GR No</th>
                <td>{{ ($student->gr_no ?? 'N/A') }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $student->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>{{ $student->dob ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>{{ ucfirst($student->gender ?? 'N/A') }}</td>
            </tr>
            <tr>
                <th>Contact No</th>
                <td>{{ $student->contact_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $student->email ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $student->address ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Guardian Name</th>
                <td>{{ $student->guardian_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Guardian Contact No</th>
                <td>{{ $student->guardian_contact_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>WhatsApp No</th>
                <td>{{ $student->whatsapp_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Religion</th>
                <td>{{ $student->religion ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Nationality</th>
                <td>{{ $student->nationality ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Zakat</th>
                <td>{{ $student->zakat ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <th>Security Deposit Amount</th>
                <td>{{ $student->security_deposit_amount ? number_format($student->security_deposit_amount, 2) : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Deduction Amount</th>
                <td>{{ $student->deduction_amount ? number_format($student->deduction_amount, 2) : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Refund Amount</th>
                <td>{{ $student->refund_amount ? number_format($student->refund_amount, 2) : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Days</th>
                <td>{{ $student->days ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Start Time</th>
                <td>{{ $student->start_time ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>End Time</th>
                <td>{{ $student->end_time ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>

    <h4>Courses</h4>
    @if(!empty($student->courses) && count($student->courses) > 0)
        @foreach($student->courses as $course)
            <span class="badge badge-secondary">{{ $course->name ?? 'N/A' }}</span>
        @endforeach
    @else
        <span class="badge badge-danger">No courses assigned.</span>
    @endif

    <h4 style="margin-top:15px;">Academic Records</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Qualification</th>
                <th>Year</th>
                <th>Institute</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $student->academicRecords->qualification ?? 'N/A' }}</td>
                <td>{{ $student->academicRecords->year ?? 'N/A' }}</td>
                <td>{{ $student->academicRecords->institute_name ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Generated on: {{ now()->format('d-m-Y h:i A') }}
    </div>
</body>
</html>

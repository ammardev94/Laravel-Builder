<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Donor - {{ $donor->donor_name ?? 'Unknown' }}</title>
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
            background-color: #6c757d;
            color: #fff;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Donor Details</h2>

    <table class="table">
        <tbody>
            <tr><th>Donor Name</th><td>{{ $donor->donor_name ?? 'N/A' }}</td></tr>
            <tr><th>WhatsApp</th><td>{{ $donor->donor_whatsapp ?? 'N/A' }}</td></tr>
            <tr><th>Reference Name</th><td>{{ $donor->donor_ref_name ?? 'N/A' }}</td></tr>
            <tr><th>Secondary WhatsApp</th><td>{{ $donor->donor_whatsapp_sec ?? 'N/A' }}</td></tr>
            <tr><th>Created On</th><td>{{ $donor->created_on ?? 'N/A' }}</td></tr>
            <tr><th>Updated On</th><td>{{ $donor->updated_on ?? 'N/A' }}</td></tr>
        </tbody>
    </table>

    <h4>Associated Students</h4>
    @if($donor->students && $donor->students->count() > 0)
        @foreach($donor->students as $student)
            <span class="badge">
                {{ $student->stu_full_name ?? 'N/A' }} (GR No: {{ $student->gr_num ?? 'N/A' }})
            </span>
        @endforeach
    @else
        <span class="badge">No student records found.</span>
    @endif

    <div class="footer">
        Generated on: {{ now()->format('d-m-Y h:i A') }}
    </div>
</body>
</html>

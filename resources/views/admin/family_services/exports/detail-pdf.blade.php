<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Family Service - {{ $familyService->service ?? 'Unknown' }}</title>
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
    </style>
</head>
<body>
    <h2 style="text-align: center;">Family Service Details</h2>

    <table class="table">
        <tbody>
            <tr>
                <th>Service</th>
                <td>{{ $familyService->service ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $familyService->date ? \Carbon\Carbon::parse($familyService->date)->format('d-m-Y') : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Family</th>
                <td>
                    @if($familyService->family)
                        {{ $familyService->family->father_name ?? 'N/A' }} 
                        (Family ID: {{ $familyService->family->id }})
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr>
                <th>Created On</th>
                <td>{{ $familyService->created_on ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Updated On</th>
                <td>{{ $familyService->updated_on ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Generated on: {{ now()->format('d-m-Y h:i A') }}
    </div>
</body>
</html>

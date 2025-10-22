<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Donors</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Donors List</h2>

    <table>
        <thead>
            <tr>
                <th>Donor Name</th>
                <th>WhatsApp</th>
                <th>Reference Name</th>
                <th>Second WhatsApp</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($donors as $donor)
                <tr>
                    <td>{{ $donor->donor_name }}</td>
                    <td>{{ $donor->donor_whatsapp ?? '-' }}</td>
                    <td>{{ $donor->donor_ref_name ?? '-' }}</td>
                    <td>{{ $donor->donor_whatsapp_sec ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No donors found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>

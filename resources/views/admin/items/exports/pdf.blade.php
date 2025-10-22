<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Items List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto 30px auto;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        /* Footer Styles */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
            border-top: 1px solid #000;
            padding: 8px 0;
        }
    </style>
</head>
<body>

<h2>Items List</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Slug</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $index => $record)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $record->name ?? 'N/A' }}</td>
                <td>{{ $record->slug ?? 'N/A' }}</td>
                <td>{{ $record->created_at ? \Carbon\Carbon::parse($record->created_at)->format('d M Y') : 'N/A' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align:center;">No records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    <p>Generated on {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}</p>
</div>

</body>
</html>

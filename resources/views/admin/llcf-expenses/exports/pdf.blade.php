<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>LLCF Expenses Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
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

<h2>LLCF Expenses Report</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Item Name</th>
            <th>Expense Type</th>
            <th>Amount (PKR)</th>
            <th>Date</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @forelse($expenses as $index => $expense)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $expense->item?->name ?? 'N/A' }}</td>
                <td>{{ strtoupper($expense->type) }}</td>
                <td>{{ number_format($expense->amount, 2) }}</td>
                <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($expense->created_at)->format('d M Y, h:i A') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;">No expense records found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    <p>Generated on {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}</p>
</div>

</body>
</html>

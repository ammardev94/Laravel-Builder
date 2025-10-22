<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Companies PDF Export</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h2>Companies Report</h2>

    <table>
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Unit Price</th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
                <tr>
                    <td>{{ $company->companyName }}</td>
                    <td>{{ $company->companyPhone }}</td>
                    <td>{{ $company->companyAddress }}</td>
                    <td>{{ number_format($company->unitPrice, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No companies found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>

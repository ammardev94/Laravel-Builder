<!DOCTYPE html>
<html>
<head>
    <title>Families PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
        }
    </style>
</head>
<body>
    <h2>Families List</h2>
    <table>
        <thead>
            <tr>
                <th>Father Name</th>
                <th>Father CNIC</th>
                <th>Mother Name</th>
                <th>Phone</th>
                <th>Children</th>
                <th>Zakat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($families as $family)
            <tr>
                <td>{{ $family->father_name }}</td>
                <td>{{ $family->father_cnic }}</td>
                <td>{{ $family->mother_name }}</td>
                <td>{{ $family->father_phone }}</td>
                <td>{{ $family->children_count }}</td>
                <td>{{ $family->zakat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

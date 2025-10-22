<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students PDF Export</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }

        .small {
            font-size: 10px;
        }
    </style>
</head>
<body>

    <h2>Students Report</h2>

    <table>
        <thead>
            <tr>
              <th>GR No</th>
              <th>Student Name</th>
              <th>Class</th>
              <th>Father Name</th>
              <th>Donar Name</th>
              <th>Donation Expiry</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->gr_num }}</td>
                    <td>{{ $student->stu_full_name }}</td>
                    <td>{{ $student->class }}</td>
                    <td>{{ $student->family->father_name ?? '-' }}</td>
                    <td>{{ $student->donor->donor_name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($student->donation_expiry)->format('D F d, Y') ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

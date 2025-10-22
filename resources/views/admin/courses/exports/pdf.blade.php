<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Courses Export</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Courses List</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $index => $course)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->code }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

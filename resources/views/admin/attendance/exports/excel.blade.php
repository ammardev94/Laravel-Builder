<table>
    <thead>
        <tr>
            <th>Student Name</th>
            <th>Class</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendances as $attendance)
        <tr>
            <td>{{ $attendance->student->stu_full_name ?? 'N/A' }}</td>
            <td>{{ $attendance->class }}</td>
            <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
            <td>{{ ucfirst($attendance->attendance) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Student Name</th>
            <th>GR No</th>
            <th>Attendance</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vtcAttendences as $record)
            <tr>
                <td>{{ \Carbon\Carbon::parse($record->date)->format('d-m-Y') }}</td>
                <td>{{ $record->vtcStudent->name ?? 'N/A' }}</td>
                <td>{{ $record->gr_no }}</td>
                <td>{{ ucfirst($record->attendence) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th>Student</th>
            <th>Family</th>
            <th>Checkup Date</th>
            <th>Pulse</th>
            <th>Body Temp</th>
            <th>Respiration</th>
            <th>BP</th>
            <th>Height (cm)</th>
            <th>Weight</th>
            <th>BMI</th>
            <th>Diagnosis</th>
            <th>Advice</th>
        </tr>
    </thead>
    <tbody>
        @foreach($healthRecords as $record)
        <tr>
            <td>{{ $record->student->stu_full_name ?? 'N/A' }}</td>
            <td>{{ $record->family->father_name ?? 'N/A' }}</td>
            <td>{{ \Carbon\Carbon::parse($record->checkup_date)->format('d-m-Y') }}</td>
            <td>{{ $record->pulse }}</td>
            <td>{{ $record->body_temp }}</td>
            <td>{{ $record->respiration }}</td>
            <td>{{ $record->bp }}</td>
            <td>{{ $record->height_cm }}</td>
            <td>{{ $record->weight }}</td>
            <td>{{ $record->bmi }}</td>
            <td>{{ $record->diagnosis }}</td>
            <td>{{ $record->advice }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

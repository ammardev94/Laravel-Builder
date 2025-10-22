<table>
    <thead>
        <tr>
            <th>Student</th>
            <th>Service</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($studentServices as $service)
        <tr>
            <td>{{ $service->student->stu_full_name ?? 'N/A' }}</td>
            <td>{{ $service->service }}</td>
            <td>{{ \Carbon\Carbon::parse($service->date)->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

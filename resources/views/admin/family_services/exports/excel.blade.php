<table>
    <thead>
        <tr>
            <th>Family</th>
            <th>Service</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($familyServices as $service)
        <tr>
            <td>{{ $service->family->father_name ?? 'N/A' }}</td>
            <td>{{ $service->service }}</td>
            <td>{{ \Carbon\Carbon::parse($service->date)->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

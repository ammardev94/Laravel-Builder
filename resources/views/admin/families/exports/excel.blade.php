<table>
    <thead>
        <tr>
            <th>Father Name</th>
            <th>Father CNIC</th>
            <th>Father Phone</th>
            <th>Mother Name</th>
            <th>Mother CNIC</th>
            <th>Occupation (Father)</th>
            <th>Occupation (Mother)</th>
            <th>Address</th>
            <th>Religion</th>
            <th>Zakat Eligible</th>
            <th>Total Students</th>
        </tr>
    </thead>
    <tbody>
        @foreach($families as $family)
        <tr>
            <td>{{ $family->father_name }}</td>
            <td>{{ $family->father_cnic }}</td>
            <td>{{ $family->father_phone }}</td>
            <td>{{ $family->mother_name }}</td>
            <td>{{ $family->mother_cnic }}</td>
            <td>{{ $family->father_occup }}</td>
            <td>{{ $family->mother_occup }}</td>
            <td>{{ $family->address }}</td>
            <td>{{ $family->religion }}</td>
            <td>{{ $family->zakat ? 'Yes' : 'No' }}</td>
            <td>{{ $family->students_count }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

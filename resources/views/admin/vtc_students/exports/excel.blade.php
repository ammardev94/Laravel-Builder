<table>
    <thead>
        <tr>
            <th>GR No</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Contact No</th>
            <th>Email</th>
            <th>Address</th>
            <th>Guardian Name</th>
            <th>Guardian Contact</th>
            <th>Religion</th>
            <th>Nationality</th>
            <th>Courses</th>
            <th>Qualification</th>
            <th>Year</th>
            <th>Institute</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vtcStudents as $student)
        <tr>
            <td>{{ $student->gr_no }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->dob }}</td>
            <td>{{ ucfirst($student->gender) }}</td>
            <td>{{ $student->contact_no }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->address }}</td>
            <td>{{ $student->guardian_name }}</td>
            <td>{{ $student->guardian_contact_no }}</td>
            <td>{{ $student->religion }}</td>
            <td>{{ $student->nationality }}</td>
            <td>
                @if($student->courses->count())
                    {{ $student->courses->pluck('name')->join(', ') }}
                @else
                    N/A
                @endif
            </td>
            <td>{{ optional($student->academicRecords)->qualification }}</td>
            <td>{{ optional($student->academicRecords)->year }}</td>
            <td>{{ optional($student->academicRecords)->institute_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th>GR No</th>
            <th>Full Name</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Class</th>
            <th>Father Name</th>
            <th>Donar Name</th>
            <th>Donation Date</th>
            <th>Donation Expiry</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->gr_num }}</td>
            <td>{{ $student->stu_full_name }}</td>
            <td>{{ $student->stu_dob }}</td>
            <td>{{ ucfirst($student->stu_gender) }}</td>
            <td>{{ $student->class }}</td>
            <td>{{ $student->family->father_name ?? '-' }}</td>
            <td>{{ $student->donor->donor_name ?? '-' }}</td>
            <td>{{ $student->donation_date }}</td>
            <td>{{ $student->donation_expiry }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

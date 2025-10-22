@extends('admin.default')

@section('css')
<style>
    .table td {
        white-space: unset;
    }
    .profile-img {
        max-width: 150px;
        border-radius: 8px;
    }
    .table th {
        width: 30%;
    }
</style>
@endsection

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Students</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
          <li class="breadcrumb-item active">View</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Student Details</h3>
                            <a href="{{ route('admin.students.export_pdf', [$student->id]) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export to PDF
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <tbody>
                                <tr><th>Full Name</th><td>{{ $student->stu_full_name ?? 'N/A' }}</td></tr>
                                <tr><th>GR Number</th><td>{{ $student->gr_num ?? 'N/A' }}</td></tr>
                                {{-- <tr><th>Auto GR Number</th><td>{{ $student->auto_gr_num ?? 'N/A' }}</td></tr> --}}
                                <tr><th>Date of Birth</th><td>{{ $student->stu_dob ?? 'N/A' }}</td></tr>
                                <tr><th>Gender</th><td>{{ $student->stu_gender ? ucfirst($student->stu_gender) : 'N/A' }}</td></tr>
                                <tr><th>Class</th><td>{{ $student->class ?? 'N/A' }}</td></tr>
                                <tr><th>Family</th>
                                    <td>
                                        @if($student->family)
                                            {{ $student->family->father_name ?? 'N/A' }} (Family ID: {{ $student->family->id }})
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr><th>Donor</th>
                                    <td>
                                        @if($student->donor)
                                            {{ $student->donor->donor_name ?? 'N/A' }} (ID: {{ $student->donor->id }})
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr><th>Donation Date</th><td>{{ $student->donation_date ?? 'N/A' }}</td></tr>
                                <tr><th>Donation Expiry</th><td>{{ $student->donation_expiry ?? 'N/A' }}</td></tr>
                                <tr><th>Created On</th><td>{{ $student->created_on ?? 'N/A' }}</td></tr>
                                <tr><th>Updated On</th><td>{{ $student->updated_on ?? 'N/A' }}</td></tr>
                            </tbody>
                        </table>

                        <hr>

                        <h5 class="mb-3">Attendances</h5>
                        @if($student->attendances && $student->attendances->count())
                            <ul>
                                @foreach($student->attendances as $attendance)
                                    <li>({{ $attendance->date ?? 'N/A' }}) - {{ $attendance->class ?? 'N/A' }} - {{ ucfirst($attendance->attendance) ?? 'N/A' }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="badge badge-info">No attendance records found.</span>
                        @endif

                        <hr>

                        <h5 class="mb-3">Student Services</h5>
                        @if($student->studentServices && $student->studentServices->count())
                            <ul>
                                @foreach($student->studentServices as $service)
                                    <li>({{ $service->date ?? 'N/A' }}) - {{ $service->service ?? 'N/A' }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="badge badge-secondary">No services found.</span>
                        @endif

                        <hr>

                        <h5 class="mb-3">Health Records</h5>
                        @if($student->healthRecords && $student->healthRecords->count())
                            <ul>
                                @foreach($student->healthRecords as $record)
                                    <li>{{ $record->diagnosis ?? 'N/A' }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="badge badge-secondary">No health records found.</span>
                        @endif

                        <div class="mt-3">
                            <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

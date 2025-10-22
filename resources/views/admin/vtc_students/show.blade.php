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
        <h1 class="m-0">VTC Students</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.vtc_students.indexV3') }}">VTC Students</a></li>
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
                            <a href="{{ route('admin.vtc_students.export_pdf', $student->id) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export to PDF
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="{{ $student->img ? asset('storage/'.$student->img) : asset('adminlte/images/llcf-white-header.png') }}"
                                 class="profile-img"
                                 alt="Student Image">
                        </div>

                        <table class="table table-bordered">
                            <tbody>
                                <tr><th>GR No</th><td>{{ $student->gr_no ?? 'N/A' }}</td></tr>
                                <tr><th>Name</th><td>{{ $student->name ?? 'N/A' }}</td></tr>
                                <tr><th>Date of Birth</th><td>{{ $student->dob ?? 'N/A' }}</td></tr>
                                <tr><th>Gender</th><td>{{ $student->gender ? ucfirst($student->gender) : 'N/A' }}</td></tr>
                                <tr><th>Contact No</th><td>{{ $student->contact_no ?? 'N/A' }}</td></tr>
                                <tr><th>Email</th><td>{{ $student->email ?? 'N/A' }}</td></tr>
                                <tr><th>Address</th><td>{{ $student->address ?? 'N/A' }}</td></tr>
                                <tr><th>Guardian Name</th><td>{{ $student->guardian_name ?? 'N/A' }}</td></tr>
                                <tr><th>Guardian Contact No</th><td>{{ $student->guardian_contact_no ?? 'N/A' }}</td></tr>
                                <tr><th>WhatsApp No</th><td>{{ $student->whatsapp_no ?? 'N/A' }}</td></tr>
                                <tr><th>Religion</th><td>{{ $student->religion ?? 'N/A' }}</td></tr>
                                <tr><th>Nationality</th><td>{{ $student->nationality ?? 'N/A' }}</td></tr>
                                <tr><th>Zakat</th><td>{{ $student->zakat ? 'Yes' : 'No' }}</td></tr>
                                <tr><th>Security Deposit Amount</th><td>{{ $student->security_deposit_amount ? number_format($student->security_deposit_amount, 2) : 'N/A' }}</td></tr>
                                <tr><th>Deduction Amount</th><td>{{ $student->deduction_amount ? number_format($student->deduction_amount, 2) : 'N/A' }}</td></tr>
                                <tr><th>Refund Amount</th><td>{{ $student->refund_amount ? number_format($student->refund_amount, 2) : 'N/A' }}</td></tr>
                                <tr><th>Days</th><td>{{ $student->days ?? 'N/A' }}</td></tr>
                                <tr><th>Start Time</th><td>{{ $student->start_time ?? 'N/A' }}</td></tr>
                                <tr><th>End Time</th><td>{{ $student->end_time ?? 'N/A' }}</td></tr>
                            </tbody>
                        </table>
                        
                        <hr>
                        
                        <h5 class="mb-3">Courses</h5>
                        @if($student->courses && $student->courses->count())
                            @foreach($student->courses as $course)
                                <span class="badge badge-secondary">{{ $course->name }}</span>
                            @endforeach
                        @else
                            <span class="badge badge-danger">No courses assigned.</span>
                        @endif

                        <hr>

                        <h5 class="mb-3">Academic Records</h5>
                        @if($student->academicRecords)
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Qualification</th>
                                        <th>Year</th>
                                        <th>Institute</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $student->academicRecords->qualification ?? 'N/A' }}</td>
                                        <td>{{ $student->academicRecords->year ?? 'N/A' }}</td>
                                        <td>{{ $student->academicRecords->institute_name ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">No academic record found.</p>
                        @endif

                        <div class="mt-3">
                            <a href="{{ route('admin.vtc_students.indexV3') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <a href="{{ route('admin.vtc_students.edit', $student->id) }}" class="btn btn-primary">
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

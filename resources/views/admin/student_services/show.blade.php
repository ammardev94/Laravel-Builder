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
        <h1 class="m-0">Student Services</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.student_services.index') }}">Student Services</a></li>
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
                            <h3 class="card-title">Student Service Details</h3>
                            <a href="{{ route('admin.student_services.export_pdf', [$studentService->id]) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export to PDF
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <tbody>
                                <tr><th>Service</th><td>{{ $studentService->service ?? 'N/A' }}</td></tr>
                                <tr><th>Date</th><td>{{ $studentService->date ?? 'N/A' }}</td></tr>
                                <tr><th>Created On</th><td>{{ $studentService->created_on ?? 'N/A' }}</td></tr>
                                <tr><th>Updated On</th><td>{{ $studentService->updated_on ?? 'N/A' }}</td></tr>
                            </tbody>
                        </table>

                        <hr>

                        <h5 class="mb-3">Student</h5>
                        @if($studentService->student)
                            <ul>
                                <li>{{ $studentService->student->stu_full_name ?? 'N/A' }} (GR No: {{ $studentService->student->gr_num ?? 'N/A' }})</li>
                            </ul>
                        @else
                            <span class="badge badge-info">No student record found.</span>
                        @endif

                        <div class="mt-3">
                            <a href="{{ route('admin.student_services.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <a href="{{ route('admin.student_services.edit', $studentService->id) }}" class="btn btn-primary">
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

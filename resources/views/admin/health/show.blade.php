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
        <h1 class="m-0">Health Record</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.health.index') }}">Health Records</a></li>
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
                            <h3 class="card-title">Health Record Details</h3>
                            <a href="{{ route('admin.health.export_pdf', [$health->id]) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export to PDF
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <tbody>
                                <tr><th>Checkup Date</th><td>{{ $health->checkup_date ?? 'N/A' }}</td></tr>
                                <tr><th>Pulse</th><td>{{ $health->pulse ?? 'N/A' }}</td></tr>
                                <tr><th>Body Temperature</th><td>{{ $health->body_temp ?? 'N/A' }}</td></tr>
                                <tr><th>Respiration</th><td>{{ $health->respiration ?? 'N/A' }}</td></tr>
                                <tr><th>Blood Pressure</th><td>{{ $health->bp ?? 'N/A' }}</td></tr>
                                <tr><th>Height (cm)</th><td>{{ $health->height_cm ?? 'N/A' }}</td></tr>
                                <tr><th>Weight</th><td>{{ $health->weight ?? 'N/A' }}</td></tr>
                                <tr><th>BMI</th><td>{{ $health->bmi ?? 'N/A' }}</td></tr>
                                <tr><th>BMI Percentile</th><td>{{ $health->bmi_percentile ?? 'N/A' }}</td></tr>
                                <tr><th>Eye (Left)</th><td>{{ $health->eye_left ?? 'N/A' }}</td></tr>
                                <tr><th>Eye (Right)</th><td>{{ $health->eye_right ?? 'N/A' }}</td></tr>
                                <tr><th>Pallor</th><td>{{ $health->pallor ?? 'N/A' }}</td></tr>
                                <tr><th>Lice</th><td>{{ $health->lice ?? 'N/A' }}</td></tr>
                                <tr><th>Consciousness</th><td>{{ $health->consciousness ?? 'N/A' }}</td></tr>
                                <tr><th>Diet</th><td>{{ $health->diet ?? 'N/A' }}</td></tr>
                                <tr><th>Teeth</th><td>{{ $health->teeth ?? 'N/A' }}</td></tr>
                                <tr><th>History</th><td>{{ $health->history ?? 'N/A' }}</td></tr>
                                <tr><th>Diagnosis</th><td>{{ $health->diagnosis ?? 'N/A' }}</td></tr>
                                <tr><th>Management</th><td>{{ $health->management ?? 'N/A' }}</td></tr>
                                <tr><th>Advice</th><td>{{ $health->advice ?? 'N/A' }}</td></tr>
                                <tr><th>Refer</th><td>{{ $health->refer ?? 'N/A' }}</td></tr>
                                <tr><th>Follow-up</th><td>{{ $health->followup ?? 'N/A' }}</td></tr>
                                <tr><th>Session</th><td>{{ $health->session ?? 'N/A' }}</td></tr>
                                <tr><th>Created On</th><td>{{ $health->created_on ?? 'N/A' }}</td></tr>
                                <tr><th>Updated On</th><td>{{ $health->updated_on ?? 'N/A' }}</td></tr>
                            </tbody>
                        </table>

                        <hr>

                        <h5 class="mb-3">Associated Student</h5>
                        @if($health->student)
                            <ul>
                                <li>{{ $health->student->stu_full_name ?? 'N/A' }} (GR No: {{ $health->student->gr_num ?? 'N/A' }})</li>
                            </ul>
                        @else
                            <span class="badge badge-info">No student record found.</span>
                        @endif

                        <h5 class="mb-3 mt-3">Associated Family</h5>
                        @if($health->family)
                            <ul>
                                <li>{{ $health->family->father_name ?? 'N/A' }} ({{ $health->family->father_cnic ?? 'N/A' }})</li>
                            </ul>
                        @else
                            <span class="badge badge-info">No family record found.</span>
                        @endif

                        <div class="mt-3">
                            <a href="{{ route('admin.health.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <a href="{{ route('admin.health.edit', $health->id) }}" class="btn btn-primary">
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

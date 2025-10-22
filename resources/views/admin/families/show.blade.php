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
        <h1 class="m-0">Families</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.families.index') }}">Families</a></li>
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
                            <h3 class="card-title">Family Details</h3>
                            <a href="{{ route('admin.families.export_pdf', [$family->id]) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export to PDF
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <tbody>
                                <tr><th>Father Name</th><td>{{ $family->father_name ?? 'N/A' }}</td></tr>
                                <tr><th>Father CNIC</th><td>{{ $family->father_cnic ?? 'N/A' }}</td></tr>
                                <tr><th>Father Occupation</th><td>{{ $family->father_occup ?? 'N/A' }}</td></tr>
                                <tr><th>Father Phone</th><td>{{ $family->father_phone ?? 'N/A' }}</td></tr>
                                <tr><th>Mother Name</th><td>{{ $family->mother_name ?? 'N/A' }}</td></tr>
                                <tr><th>Mother CNIC</th><td>{{ $family->mother_cnic ?? 'N/A' }}</td></tr>
                                <tr><th>Mother Occupation</th><td>{{ $family->mother_occup ?? 'N/A' }}</td></tr>
                                <tr><th>Children Count</th><td>{{ $family->children_count ?? 'N/A' }}</td></tr>
                                <tr><th>Address</th><td>{{ $family->address ?? 'N/A' }}</td></tr>
                                <tr><th>Religion</th><td>{{ $family->religion ?? 'N/A' }}</td></tr>
                                <tr><th>Zakat</th><td>{{ $family->zakat ? 'Yes' : 'No' }}</td></tr>
                                <tr><th>Emergency Contact Name</th><td>{{ $family->emerg_name ?? 'N/A' }}</td></tr>
                                <tr><th>Emergency Relation</th><td>{{ $family->emerg_relation ?? 'N/A' }}</td></tr>
                                <tr><th>Emergency Number</th><td>{{ $family->emerg_num ?? 'N/A' }}</td></tr>
                                <tr><th>Created On</th><td>{{ $family->created_on ?? 'N/A' }}</td></tr>
                                <tr><th>Updated On</th><td>{{ $family->updated_on ?? 'N/A' }}</td></tr>
                            </tbody>
                        </table>

                        <hr>

                        <h5 class="mb-3">Students</h5>
                        @if($family->students && $family->students->count())
                            <ul>
                                @foreach($family->students as $student)
                                    <li>{{ $student->stu_full_name }} ({{ $student->gr_num }})</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="badge badge-info">No records found.</span>
                        @endif

                        <hr>

                        <h5 class="mb-3">Health Records</h5>
                        @if($family->healthRecords && $family->healthRecords->count())
                            <ul>
                                @foreach($family->healthRecords as $record)
                                    <li>{{ $record->diagnosis ?? 'N/A' }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="badge badge-info">No records found.</span>
                        @endif

                        <hr>

                        <h5 class="mb-3">Family Services</h5>
                        @if($family->familyServices && $family->familyServices->count())
                            <ul>
                                @foreach($family->familyServices as $service)
                                    <li>{{ $service->service ?? 'N/A' }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="badge badge-secondary">No records found.</span>
                        @endif

                        <div class="mt-3">
                            <a href="{{ route('admin.families.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <a href="{{ route('admin.families.edit', $family->id) }}" class="btn btn-primary">
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

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
        <h1 class="m-0">Donors</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.donors.index') }}">Donors</a></li>
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
                            <h3 class="card-title">Donor Details</h3>
                            <a href="{{ route('admin.donors.export_pdf', [$donor->id]) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export to PDF
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <tbody>
                                <tr><th>Donor Name</th><td>{{ $donor->donor_name ?? 'N/A' }}</td></tr>
                                <tr><th>WhatsApp</th><td>{{ $donor->donor_whatsapp ?? 'N/A' }}</td></tr>
                                <tr><th>Reference Name</th><td>{{ $donor->donor_ref_name ?? 'N/A' }}</td></tr>
                                <tr><th>Secondary WhatsApp</th><td>{{ $donor->donor_whatsapp_sec ?? 'N/A' }}</td></tr>
                                <tr><th>Created On</th><td>{{ $donor->created_on ?? 'N/A' }}</td></tr>
                                <tr><th>Updated On</th><td>{{ $donor->updated_on ?? 'N/A' }}</td></tr>
                            </tbody>
                        </table>

                        <hr>

                        <h5 class="mb-3">Associated Students</h5>
                        @if($donor->students && $donor->students->count() > 0)
                            <ul>
                                @foreach($donor->students as $student)
                                    <li>
                                        {{ $student->stu_full_name ?? 'N/A' }}
                                        (GR No: {{ $student->gr_num ?? 'N/A' }},
                                        Class: {{ $student->class ?? 'N/A' }})
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="badge badge-info">No student records found.</span>
                        @endif

                        <div class="mt-3">
                            <a href="{{ route('admin.donors.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <a href="{{ route('admin.donors.edit', $donor->id) }}" class="btn btn-primary">
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

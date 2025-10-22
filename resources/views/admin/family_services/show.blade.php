@extends('admin.default')

@section('css')
<style>
    .table td {
        white-space: unset;
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
        <h1 class="m-0">Family Services</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.family_services.index') }}">Family Services</a></li>
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
                            <h3 class="card-title">Family Service Details</h3>
                            <a href="{{ route('admin.family_services.export_pdf', [$familyService->id]) }}" class="btn btn-danger">
                                <i class="fas fa-file-pdf"></i> Export to PDF
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <tbody>
                                <tr><th>Service</th><td>{{ $familyService->service ?? 'N/A' }}</td></tr>
                                <tr><th>Date</th><td>{{ $familyService->date ? \Carbon\Carbon::parse($familyService->date)->format('d-m-Y') : 'N/A' }}</td></tr>
                                <tr><th>Family</th>
                                    <td>
                                        @if($familyService->family)
                                            <a href="{{ route('admin.families.show', $familyService->family->id) }}">
                                                {{ $familyService->family->father_name ?? 'N/A' }}
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr><th>Created On</th><td>{{ $familyService->created_on ?? 'N/A' }}</td></tr>
                                <tr><th>Updated On</th><td>{{ $familyService->updated_on ?? 'N/A' }}</td></tr>
                            </tbody>
                        </table>

                        <div class="mt-3">
                            <a href="{{ route('admin.family_services.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                            <a href="{{ route('admin.family_services.edit', $familyService->id) }}" class="btn btn-primary">
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

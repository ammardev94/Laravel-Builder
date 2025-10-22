@extends('admin.default')

@section('css')
<style>
    .table td {
        white-space: unset;
    }

    .swal2-confirm.red-button {
        background-color: red !important;
        border-color: red !important;
        color: white !important;
    }

    .select2-container .select2-selection--single {
        height: 38px !important;
        padding: 6px 12px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }


</style>
@endsection

@section('content')

<!-- Page Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Health Records</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Health Records</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Content -->
<div class="content">
  <div class="container-fluid">
    @include('include.messages')

    <!-- Filter Form -->
    <div class="card mb-3">
        <div class="card-body pt-3 pb-1">
            <form method="GET" action="{{ route('admin.health.index') }}">
                <div class="form-row align-items-end">
                    <div class="col-md-3 mb-2">
                        <select id="student_id" name="student_id" class="form-control">
                            <option value="">Select Student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->stu_full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <select id="family_id" name="family_id" class="form-control">
                            <option value="">Select Family</option>
                            @foreach($families as $family)
                                <option value="{{ $family->id }}" {{ request('family_id') == $family->id ? 'selected' : '' }}>
                                    {{ $family->father_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="date" name="checkup_date" value="{{ request('checkup_date') }}" class="form-control">
                    </div>
                    <div class="col-md-3 mb-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search"></i> Filter</button>
                        <a href="{{ route('admin.health.index') }}" class="btn btn-secondary"><i class="fas fa-times-circle"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Health Records</h3>
            <a class="btn btn-primary" href="{{ route('admin.health.create') }}">
                <i class="fas fa-solid fa-plus"></i>
            </a>
        </div>
      </div>

      <div class="card-body p-0">
        <div class="mb-3 d-flex justify-content-start">
            <a href="{{ route('admin.health.export.excel', request()->query()) }}" class="btn btn-success mr-2">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ route('admin.health.export.pdf', request()->query()) }}" class="btn btn-danger mr-2">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            <a href="{{ route('admin.health.export.csv', request()->query()) }}" class="btn btn-success">
                <i class="fas fa-file-csv"></i> Export CSV
            </a>
        </div>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Family Name</th>
              <th>Checkup Date</th>
              <th>BMI</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($healthRecords as $record)
              <tr>
                <td>{{ $record->student->stu_full_name ?? '-' }}</td>
                <td>{{ $record->family->father_name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($record->checkup_date)->format('d M Y') }}</td>
                <td>{{ $record->bmi ?? '-' }}</td>
                <td class="text-center">
                  <div class='btn-group'>
                    <a href="{{ route('admin.health.show', $record->id) }}" class="btn btn-default btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.health.edit', $record->id) }}" class="btn btn-default btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form class="delete-health-form" action="{{ route('admin.health.destroy', $record->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-default btn-sm">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">No health records found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($healthRecords->total() > 2)
        <div class="card-footer">
          <div class="d-flex justify-content-end">
            {{ $healthRecords->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
          </div>
        </div>
      @endif
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {

        $('#student_id').select2({ placeholder: 'Select Student' });
        $('#family_id').select2({ placeholder: 'Select Family' });


        $(".delete-health-form").on("submit", function (e) {
            e.preventDefault();
            Swal.fire({
                title: "<strong>Are you sure?</strong>",
                icon: "warning",
                html: `<p>Do you really want to delete this health record?</p>`,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: `<i class="fa fa-trash"></i> Yes, delete it!`,
                cancelButtonText: `<i class="fa fa-times"></i> Cancel`,
                allowOutsideClick: false,
                customClass: {
                    confirmButton: 'red-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@endsection

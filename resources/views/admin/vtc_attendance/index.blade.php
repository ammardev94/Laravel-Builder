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
        <h1 class="m-0">VTC Attendance</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">VTC Attendance</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="content">
  <div class="container-fluid">
    @include('include.messages')

    <!-- Filter Form -->
    <div class="card mb-3">
      <div class="card-body pt-3 pb-1">
        <form method="GET" action="{{ route('admin.vtc_attendance.index') }}">
          <div class="form-row align-items-end">
            <div class="col-md-4 mb-2">
              <select id="vtc_student_id" name="vtc_student_id" class="form-control">
                <option value="">Select Student</option>
                @foreach ($students as $student)
                  <option value="{{ $student->id }}" {{ request('vtc_student_id') == $student->id ? 'selected' : '' }}>
                    {{ $student->name }} (GR No: {{ $student->gr_no }})
                  </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-4 mb-2">
              <input type="date" name="date" value="{{ request('date') }}" class="form-control">
            </div>

            <div class="col-md-4 mb-2 d-flex gap-2">
              <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search"></i> Filter</button>
              <a href="{{ route('admin.vtc_attendance.index') }}" class="btn btn-secondary"><i class="fas fa-times-circle"></i> Reset</a>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Table -->
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h3 class="card-title mb-0">Attendance Records</h3>
          <a class="btn btn-primary" href="{{ route('admin.vtc_attendance.create') }}">
            <i class="fas fa-solid fa-plus"></i>
          </a>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="mb-3 d-flex justify-content-start px-3">
          <a href="{{ route('admin.vtc_attendance.export.excel', request()->query()) }}" class="btn btn-success mr-2">
              <i class="fas fa-file-excel"></i> Export Excel
          </a>
          <a href="{{ route('admin.vtc_attendance.export.pdf', request()->query()) }}" class="btn btn-danger mr-2">
            <i class="fas fa-file-pdf"></i> Export PDF
          </a>
          <a href="{{ route('admin.vtc_attendance.export.csv', request()->query()) }}" class="btn btn-success">
            <i class="fas fa-file-csv"></i> Export CSV
          </a>
        </div>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>GR No</th>
              <th>Student Name</th>
              <th>Date</th>
              <th>Attendance</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($attendances as $record)
              <tr>
                <td>{{ $record->gr_no ?? 'N/A' }}</td>
                <td>{{ $record->vtcStudent->name ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}</td>
                <td>
                    <span class="badge {{ $record->attendence === 'present' ? 'badge-success' : 'badge-danger' }}">
                        {{ ucfirst($record->attendence) }}
                    </span>
                </td>
                <td class="text-center">
                  <div class='btn-group'>
                    <a href="{{ route('admin.vtc_attendance.edit', $record->id) }}" class="btn btn-default btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form class="delete-attendance-form" action="{{ route('admin.vtc_attendance.destroy', $record->id) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-default btn-sm">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">No attendance records found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($attendances->total() > 10)
        <div class="card-footer">
          <div class="d-flex justify-content-end">
            {{ $attendances->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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
    $('#vtc_student_id').select2({ placeholder: 'Select Student' });

    $(".delete-attendance-form").on("submit", function (e) {
      e.preventDefault();
      Swal.fire({
        title: "<strong>Are you sure?</strong>",
        icon: "warning",
        html: `<p>Do you really want to delete this VTC attendance record?</p>`,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: `<i class="fa fa-trash"></i> Yes, delete it!`,
        cancelButtonText: `<i class="fa fa-times"></i> Cancel`,
        allowOutsideClick: false,
        customClass: { confirmButton: 'red-button' }
      }).then((result) => {
        if (result.isConfirmed) {
          this.submit();
        }
      });
    });
  });
</script>
@endsection

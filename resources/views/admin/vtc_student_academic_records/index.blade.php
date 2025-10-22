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
</style>
@endsection

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">VTC Student Academic Records</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Academic Records</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('include.messages')

                <!-- Filter Form -->
                <div class="card mb-3">
                    <div class="card-body pt-3 pb-1">
                        <form method="GET" action="{{ route('admin.vtc_student_academic_records.index') }}">
                            <div class="form-row align-items-end">
                                
                                {{-- Student Name Filter --}}
                                <div class="col-md-3 mb-2">
                                    <select name="student_name" class="form-control select2" data-placeholder="Select Student">
                                        <option value="">Select Student</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->name }}" {{ request('student_name') == $student->name ? 'selected' : '' }}>
                                                {{ $student->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Qualification Filter --}}
                                <div class="col-md-3 mb-2">
                                    <input type="text" name="qualification" class="form-control" placeholder="Qualification" value="{{ request('qualification') }}">
                                </div>

                                {{-- Year Filter --}}
                                <div class="col-md-2 mb-2">
                                    <input type="number" name="year" class="form-control" placeholder="Year" value="{{ request('year') }}">
                                </div>

                                {{-- Buttons --}}
                                <div class="col-md-4 mb-2 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="fas fa-search"></i> Filter
                                    </button>
                                    <a href="{{ route('admin.vtc_student_academic_records.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times-circle"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Academic Records</h3>
                            <a class="btn btn-primary" href="{{ route('admin.vtc_student_academic_records.create') }}">
                                <i class="fas fa-solid fa-plus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="mb-3 d-flex justify-content-start">
                            <a href="{{ route('admin.vtc_student_academic_records.export.pdf', request()->query()) }}" class="btn btn-danger mr-2">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </a>
                            <a href="{{ route('admin.vtc_student_academic_records.export.csv', request()->query()) }}" class="btn btn-success">
                                <i class="fas fa-file-csv"></i> Export CSV
                            </a>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Institution</th>
                                    <th>Degree</th>
                                    <th>Passing Year</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($academicRecords as $record)
                                <tr>
                                    <td>{{ $record->student->name ?? '-' }}</td>
                                    <td>{{ $record->institute_name }}</td>
                                    <td>{{ $record->qualification }}</td>
                                    <td>{{ $record->year }}</td>
                                    <td class="text-center">
                                        <div class='btn-group'>
                                            <a href="{{ route('admin.vtc_student_academic_records.edit', $record->id) }}" class="btn btn-default btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form class="delete-record-form" action="{{ route('admin.vtc_student_academic_records.destroy', $record->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-default btn-sm">
                                                    <i class="fas fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No academic records found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($academicRecords->total() > 2)
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                {{ $academicRecords->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {

        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: "Select Student",
            allowClear: true
        });


        $(".delete-record-form").on("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "<strong>Are you sure?</strong>",
                icon: "warning",
                html: `<p>Do you really want to delete this academic record?</p>`,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: `<i class="fa fa-trash"></i> Yes, delete it!`,
                confirmButtonAriaLabel: "Confirm deletion",
                cancelButtonText: `<i class="fa fa-times"></i> Cancel`,
                cancelButtonAriaLabel: "Cancel deletion",
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

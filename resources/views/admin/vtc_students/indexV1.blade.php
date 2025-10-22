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
        <h1 class="m-0">VTC Students</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">VTC Students</li>
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
                        <form method="GET" action="{{ route('admin.vtc_students.indexV3') }}">
                            <div class="form-row align-items-end">
                                <div class="col-md-3 mb-2">
                                    <input type="text" name="name" class="form-control" placeholder="Student Name" value="{{ request('name') }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <input type="text" name="gr_no" class="form-control" placeholder="GR No" value="{{ request('gr_no') }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <input type="text" name="contact_no" class="form-control" placeholder="Contact No" value="{{ request('contact_no') }}">
                                </div>
                                <div class="col-md-3 mb-2 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="fas fa-search"></i> Filter
                                    </button>
                                    <a href="{{ route('admin.vtc_students.indexV3') }}" class="btn btn-secondary">
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
                            <h3 class="card-title mb-0">VTC Students</h3>
                            <a class="btn btn-primary" href="{{ route('admin.vtc_students.create') }}">
                                <i class="fas fa-solid fa-plus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="mb-3 d-flex justify-content-start">
                            <a href="{{ route('admin.vtc_students.export.excel', request()->query()) }}" class="btn btn-success mr-2">
                                <i class="fas fa-file-excel"></i> Export Excel
                            </a>
                            <a href="{{ route('admin.vtc_students.export.pdf', request()->query()) }}" class="btn btn-danger mr-2">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </a>
                            <a href="{{ route('admin.vtc_students.export.csv', request()->query()) }}" class="btn btn-success">
                                <i class="fas fa-file-csv"></i> Export CSV
                            </a>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>GR No</th>
                                    <th>Name</th>
                                    <th>Guardian Name</th>
                                    <th>Contact Number</th>
                                    <th>Course</th>
                                    <th>Timings</th>
                                    <th>Days</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vtcStudents as $student)
                                <tr>
                                    <td>
                                        @if($student->img)
                                            <img src="{{ asset('storage/' . $student->img) }}" alt="Student Image" width="50">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $student->gr_no }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->guardian_name }}</td>
                                    <td>{{ $student->contact_no }}</td>
                                    <td>{{ optional($student->courses->first())->name ?? 'N/A' }}</td>
                                    <td>{{ $student->start_time }} - {{ $student->end_time }}</td>
                                    <td>{{ $student->days }}</td>
                                    <td class="text-center">
                                        <div class='btn-group'>
                                            <a href="{{ route('admin.vtc_students.show', $student->id) }}" class="btn btn-default btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.vtc_students.edit', $student->id) }}" class="btn btn-default btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form class="delete-student-form" action="{{ route('admin.vtc_students.destroy', $student->id) }}" method="POST">
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
                                    <td colspan="9" class="text-center">No students found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($vtcStudents->total() > 2)
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                {{ $vtcStudents->links('vendor.pagination.bootstrap-4') }}
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
        $(".delete-student-form").on("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "<strong>Are you sure?</strong>",
                icon: "warning",
                html: `<p>Do you really want to delete this student?</p>`,
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

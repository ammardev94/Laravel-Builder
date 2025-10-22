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
        <h1 class="m-0">Courses</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Courses</li>
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
                        <form method="GET" action="{{ route('admin.courses.index') }}">
                            <div class="form-row align-items-end">
                                <div class="col-md-4 mb-2">
                                    <input type="text" name="name" class="form-control" placeholder="Course Name" value="{{ request('name') }}">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <input type="text" name="code" class="form-control" placeholder="Course Code" value="{{ request('code') }}">
                                </div>
                                <div class="col-md-4 mb-2 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <i class="fas fa-search"></i> Filter
                                    </button>
                                    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times-circle"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Courses Table -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Courses</h3>
                            <a class="btn btn-primary" href="{{ route('admin.courses.create') }}">
                                <i class="fas fa-solid fa-plus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-0">

                        <div class="mb-3 d-flex justify-content-start">
                            <a href="{{ route('admin.courses.export.pdf', request()->query()) }}" class="btn btn-danger mr-2">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </a>
                            <a href="{{ route('admin.courses.export.csv', request()->query()) }}" class="btn btn-success">
                                <i class="fas fa-file-csv"></i> Export CSV
                            </a>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($courses as $course)
                                <tr>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->code }}</td>
                                    <td class="text-center">
                                        <div class='btn-group'>
                                            <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-default btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form class="delete-course-form" action="{{ route('admin.courses.destroy', $course->id) }}" method="POST">
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
                                    <td colspan="3" class="text-center">No courses found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($courses->total() > 2)
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                {{ $courses->links('vendor.pagination.bootstrap-4') }}
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
        $(".delete-course-form").on("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "<strong>Are you sure?</strong>",
                icon: "warning",
                html: `<p>Do you really want to delete this course?</p>`,
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

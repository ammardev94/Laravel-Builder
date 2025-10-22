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

<!-- Page Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Students</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Students</li>
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
        <form method="GET" action="{{ route('admin.students.index') }}">
          <div class="form-row align-items-end">
            <div class="col-md-3 mb-2">
              <input type="text" name="gr_num" value="{{ request('gr_num') }}" class="form-control" placeholder="Enter GR number">
            </div>
            <div class="col-md-3 mb-2">
              <input type="text" name="stu_full_name" value="{{ request('stu_full_name') }}" class="form-control" placeholder="Enter student name">
            </div>
            <div class="col-md-3 mb-2">
              <input type="text" name="class" value="{{ request('class') }}" class="form-control" placeholder="Enter class">
            </div>
            <div class="col-md-3 mb-2 d-flex gap-2">
              <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search"></i> Filter</button>
              <a href="{{ route('admin.students.index') }}" class="btn btn-secondary"><i class="fas fa-times-circle"></i> Reset</a>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h3 class="card-title mb-0">Students</h3>
          <a class="btn btn-primary" href="{{ route('admin.students.create') }}">
            <i class="fas fa-solid fa-plus"></i>
          </a>
        </div>
      </div>

      <div class="card-body p-0">
        <div class="mb-3 d-flex justify-content-start">
          <a href="{{ route('admin.students.export.excel', request()->query()) }}" class="btn btn-success mr-2">
              <i class="fas fa-file-excel"></i> Export Excel
          </a>
          <a href="{{ route('admin.students.export.pdf', request()->query()) }}" class="btn btn-danger mr-2">
            <i class="fas fa-file-pdf"></i> Export PDF
          </a>
          <a href="{{ route('admin.students.export.csv', request()->query()) }}" class="btn btn-success">
            <i class="fas fa-file-csv"></i> Export CSV
          </a>
        </div>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>GR No</th>
              <th>Student Name</th>
              <th>Class</th>
              <th>Father Name</th>
              <th>Donar Name</th>
              <th>Donation Expiry</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($students as $student)
              <tr>
                <td>{{ $student->gr_num }}</td>
                <td>{{ $student->stu_full_name }}</td>
                <td>{{ $student->class }}</td>
                <td>{{ $student->family->father_name ?? '-' }}</td>
                <td>{{ $student->donor->donor_name ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($student->donation_expiry)->format('D F d, Y') ?? '-' }}</td>
                <td class="text-center">
                  <div class='btn-group'>
                    <a href="{{ route('admin.students.show', $student->id) }}" class="btn btn-default btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-default btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form class="delete-student-form" action="{{ route('admin.students.destroy', $student->id) }}" method="POST">
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
                <td colspan="7" class="text-center">No students found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($students->total() > 2)
        <div class="card-footer">
          <div class="d-flex justify-content-end">
            {{ $students->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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

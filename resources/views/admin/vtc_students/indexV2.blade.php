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
                        <table id="students" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
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
                                            <img src="{{ asset('adminlte/images/default.jpg') }}" alt="Student Image" width="50">
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {

        $("#students").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "dom": 'Bfrtip',
            "buttons": [
                "copy", 
                "csv", 
                "excel", 
                "pdf", 
                "print", 
                "colvis"
            ]
        });


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

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
                            <tbody></tbody>
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

        // $('#students').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: '{{ route("admin.vtc_students.indexV3Data") }}',
        //     columns: [
        //         { data: 'image', name: 'image', orderable: false, searchable: false },
        //         { data: 'gr_no', name: 'gr_no' },
        //         { data: 'name', name: 'name' },
        //         { data: 'guardian_name', name: 'guardian_name' },
        //         { data: 'contact_no', name: 'contact_no' },
        //         { data: 'course', name: 'course' },
        //         { data: 'timings', name: 'timings' },
        //         { data: 'days', name: 'days' },
        //         { data: 'action', name: 'action', orderable: false, searchable: false }
        //     ]
        // });

        $('#students').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("admin.vtc_students.indexV3Data") }}',
            dom: 'Bfrtip',
            buttons: [
                'copy',
                'csv',
                'excel',
                'pdf',
                'print',
                'colvis'
            ],
            columns: [
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'gr_no', name: 'gr_no' },
                { data: 'name', name: 'name' },
                { data: 'guardian_name', name: 'guardian_name' },
                { data: 'contact_no', name: 'contact_no' },
                { data: 'course', name: 'course' },
                { data: 'timings', name: 'timings' },
                { data: 'days', name: 'days' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
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

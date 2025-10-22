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
            <h1 class="m-0">Families</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Families</li>
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
                            <form method="GET" action="{{ route('admin.families.index') }}">
                                <div class="form-row align-items-end">
                                    <div class="col-md-3 mb-2">
                                        <input type="text" name="father_name" class="form-control" placeholder="Father Name" value="{{ request('father_name') }}">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <input type="text" name="father_cnic" class="form-control" placeholder="Father CNIC" value="{{ request('father_cnic') }}">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <input type="text" name="father_phone" class="form-control" placeholder="Father Phone" value="{{ request('father_phone') }}">
                                    </div>
                                    <div class="col-md-3 mb-2 d-flex gap-2">
                                        <button type="submit" class="btn btn-primary mr-2">
                                            <i class="fas fa-search"></i> Filter
                                        </button>
                                        <a href="{{ route('admin.families.index') }}" class="btn btn-secondary">
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
                                <h3 class="card-title mb-0">Families</h3>
                                <a class="btn btn-primary" href="{{ route('admin.families.create') }}">
                                    <i class="fas fa-solid fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">

                            <div class="mb-3 d-flex justify-content-start">
                                <a href="{{ route('admin.families.export.excel', request()->query()) }}" class="btn btn-success mr-2">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </a>
                                <a href="{{ route('admin.families.export.pdf', request()->query()) }}" class="btn btn-danger mr-2">
                                    <i class="fas fa-file-pdf"></i> Export PDF
                                </a>
                                <a href="{{ route('admin.families.export.csv', request()->query()) }}" class="btn btn-success">
                                    <i class="fas fa-file-csv"></i> Export CSV
                                </a>
                            </div>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Family ID</th>
                                        <th>Father Name</th>
                                        <th>Father CNIC</th>
                                        <th>Father Phone</th>
                                        <th>Mother Name</th>
                                        <th>Children</th>
                                        <th>Zakat</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($families as $family)
                                    <tr>
                                        <td>{{ $family->id }}</td>
                                        <td>{{ $family->father_name }}</td>
                                        <td>{{ $family->father_cnic }}</td>
                                        <td>{{ $family->father_phone }}</td>
                                        <td>{{ $family->mother_name }}</td>
                                        <td>{{ $family->children_count }}</td>
                                        <td>{{ $family->zakat ?? '-' }}</td>
                                        <td class="text-center">
                                            <div class='btn-group'>
                                                <a href="{{ route('admin.families.show', $family->id) }}" class="btn btn-default btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.families.edit', $family->id) }}" class="btn btn-default btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form class="delete-family-form" action="{{ route('admin.families.destroy', $family->id) }}" method="POST">
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
                                        <td colspan="7" class="text-center">No families found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($families->total() > 2)
                            <div class="card-footer">
                                <div class="d-flex justify-content-end">
                                    {{ $families->links('vendor.pagination.bootstrap-4') }}
                                </div>
                            </div>
                        @endif
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $(".delete-family-form").on("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                title: "<strong>Are you sure?</strong>",
                icon: "warning",
                html: `<p>Do you really want to delete this family?</p>`,
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

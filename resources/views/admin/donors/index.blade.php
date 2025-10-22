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
        <h1 class="m-0">Donors</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Donors</li>
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
            <form method="GET" action="{{ route('admin.donors.index') }}">
                <div class="form-row align-items-end">
                    <div class="col-md-3 mb-2">
                        <input type="text" name="donor_name" value="{{ request('donor_name') }}" class="form-control" placeholder="Enter donor name">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" name="donor_whatsapp" value="{{ request('donor_whatsapp') }}" class="form-control" placeholder="Enter donor whatsapp">
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="text" name="donor_ref_name" value="{{ request('donor_ref_name') }}" class="form-control" placeholder="Enter donor ref name">
                    </div>
                    <div class="col-md-3 mb-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search"></i> Filter</button>
                        <a href="{{ route('admin.donors.index') }}" class="btn btn-secondary"><i class="fas fa-times-circle"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Donor Table -->
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Donors</h3>
            <a class="btn btn-primary" href="{{ route('admin.donors.create') }}">
                <i class="fas fa-solid fa-plus"></i>
            </a>
        </div>
      </div>

      <div class="card-body p-0">

        <div class="mb-3 d-flex justify-content-start">
            <a href="{{ route('admin.donors.export.pdf', request()->query()) }}" class="btn btn-danger mr-2">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            <a href="{{ route('admin.donors.export.csv', request()->query()) }}" class="btn btn-success">
                <i class="fas fa-file-csv"></i> Export CSV
            </a>
        </div>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>WhatsApp</th>
              <th>Ref Name</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($donors as $donor)
              <tr>
                <td>{{ $donor->donor_name }}</td>
                <td>{{ $donor->donor_whatsapp ?? '-' }}</td>
                <td>{{ $donor->donor_ref_name ?? '-' }}</td>
                <td class="text-center">
                  <div class='btn-group'>
                    <a href="{{ route('admin.donors.show', $donor->id) }}" class="btn btn-default btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.donors.edit', $donor->id) }}" class="btn btn-default btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form class="delete-donor-form" action="{{ route('admin.donors.destroy', $donor->id) }}" method="POST">
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
                <td colspan="5" class="text-center">No donors found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($donors->total() > 2)
        <div class="card-footer">
          <div class="d-flex justify-content-end">
            {{ $donors->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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
        $(".delete-donor-form").on("submit", function (e) {
            e.preventDefault();
            Swal.fire({
                title: "<strong>Are you sure?</strong>",
                icon: "warning",
                html: `<p>Do you really want to delete this donor?</p>`,
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

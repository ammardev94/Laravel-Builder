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
        <h1 class="m-0">Items</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Items</li>
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
            <form method="GET" action="{{ route('admin.items.index') }}">
              <div class="form-row align-items-end">
                <div class="col-md-6 mb-2">
                  <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Search by name">
                </div>
                <div class="col-md-6 mb-2 d-flex gap-2">
                  <button type="submit" class="btn btn-primary mr-2">
                    <i class="fas fa-search"></i> Filter
                  </button>
                  <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">
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
              <h3 class="card-title mb-0">Items List</h3>
              <a class="btn btn-primary" href="{{ route('admin.items.create') }}">
                <i class="fas fa-solid fa-plus"></i>
              </a>
            </div>
          </div>

          <div class="card-body p-0">
            <div class="mb-3 d-flex justify-content-start">
              <a href="{{ route('admin.items.export.pdf', request()->query()) }}" class="btn btn-danger mr-2">
                <i class="fas fa-file-pdf"></i> Export PDF
              </a>
              <a href="{{ route('admin.items.export.csv', request()->query()) }}" class="btn btn-success">
                <i class="fas fa-file-csv"></i> Export CSV
              </a>
            </div>

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Created At</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($items as $item)
                <tr>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->slug }}</td>
                  <td>{{ $item->created_at?->format('d M Y') }}</td>
                  <td class="text-center">
                    <div class='btn-group'>
                      <a href="{{ route('admin.items.edit', $item->id) }}" class="btn btn-default btn-sm">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form class="delete-item-form" action="{{ route('admin.items.destroy', $item->id) }}" method="POST">
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
                  <td colspan="4" class="text-center">No items found.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          @if($items->total() > 10)
          <div class="card-footer">
            <div class="d-flex justify-content-end">
              {{ $items->links('vendor.pagination.bootstrap-4') }}
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
    $(".delete-item-form").on("submit", function (e) {
      e.preventDefault();

      Swal.fire({
        title: "<strong>Are you sure?</strong>",
        icon: "warning",
        html: `<p>Do you really want to delete this item?</p>`,
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

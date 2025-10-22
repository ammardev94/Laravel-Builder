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
        <h1 class="m-0">Expenses</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Expenses</li>
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
            <form method="GET" action="{{ route('admin.expenses-llcf.index') }}">
                <div class="form-row align-items-end">
                    <div class="col-md-3 mb-2">
                        <select id="item_id" name="item_id" class="form-control">
                            <option value="">Select Item</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" {{ request('item_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="date" name="date" value="{{ request('date') }}" class="form-control">
                    </div>
                    <div class="col-md-3 mb-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search"></i> Filter</button>
                        <a href="{{ route('admin.expenses-llcf.index') }}" class="btn btn-secondary"><i class="fas fa-times-circle"></i> Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Expense Records</h3>
            <a class="btn btn-primary" href="{{ route('admin.expenses-llcf.create') }}">
                <i class="fas fa-solid fa-plus"></i>
            </a>
        </div>
      </div>

      <div class="card-body p-0">
        <div class="mb-3 d-flex justify-content-start">
            <a href="{{ route('admin.expenses-llcf.export.pdf', request()->query()) }}" class="btn btn-danger mr-2">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            <a href="{{ route('admin.expenses-llcf.export.csv', request()->query()) }}" class="btn btn-success">
                <i class="fas fa-file-csv"></i> Export CSV
            </a>
        </div>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Item</th>
              <th>Amount</th>
              <th>Date</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($expenses as $index => $record)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $record->item->name ?? '-' }}</td>
                <td>{{ $record->amount }}</td>
                <td>{{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}</td>
                <td class="text-center">
                  <div class='btn-group'>
                    <a href="{{ route('admin.expenses-llcf.edit', $record->id) }}" class="btn btn-default btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form class="delete-expense-form" action="{{ route('admin.expenses-llcf.destroy', $record->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-default btn-sm">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="text-center">No expense records found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($expenses->total() > 2)
        <div class="card-footer">
          <div class="d-flex justify-content-end">
            {{ $expenses->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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
        $('#item_id').select2({ placeholder: 'Select Item' });
        $('#type').select2({ placeholder: 'Select Type' });

        $(".delete-expense-form").on("submit", function (e) {
            e.preventDefault();
            Swal.fire({
                title: "<strong>Are you sure?</strong>",
                icon: "warning",
                html: `<p>Do you really want to delete this expense record?</p>`,
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

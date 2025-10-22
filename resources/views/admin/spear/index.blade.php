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
        <h1 class="m-0">Spear Records</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Spear</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Content -->
<div class="content">
  <div class="container-fluid">
    @include('include.messages')

    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h3 class="card-title mb-0">Spear</h3>
          <a class="btn btn-primary" href="{{ route('admin.spear.create') }}">
            <i class="fas fa-plus"></i>
          </a>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>SEMIS Code</th>
              <th>School Name</th>
              <th>Headmaster Name</th>
              <th>Contact</th>
              <th>WhatsApp</th>
              <th>Medium</th>
              <th>Student Count</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($spears as $spear)
              <tr>
                <td>{{ $spear->semis_code }}</td>
                <td>{{ $spear->school_name }}</td>
                <td>{{ $spear->hm_name }}</td>
                <td>{{ $spear->hm_contact_num }}</td>
                <td>{{ $spear->hm_whatsapp_num }}</td>
                <td>{{ $spear->medium }}</td>
                <td>{{ $spear->stu_count }}</td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="{{ route('admin.spear.edit', $spear->id) }}" class="btn btn-default btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.spear.destroy', $spear->id) }}" method="POST" class="delete-spear-form">
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
                <td colspan="8" class="text-center">No records found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($spears->total() > 2)
      <div class="card-footer">
        <div class="d-flex justify-content-end">
          {{ $spears->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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
    $(".delete-spear-form").on("submit", function (e) {
      e.preventDefault();
      Swal.fire({
        title: "<strong>Are you sure?</strong>",
        icon: "warning",
        html: `<p>Do you really want to delete this record?</p>`,
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

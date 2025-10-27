@extends('admin.default')

@section('content')

<!-- Page Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Sections — {{ $page->name }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
          <li class="breadcrumb-item active">{{ $page->name }}</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Content -->
<div class="content">
  <div class="container-fluid">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h3 class="card-title mb-0">{{ $page->name }}</h3>
          <a class="btn btn-primary" href="{{ route('admin.pages.sections.create', $page) }}">
            <i class="fas fa-solid fa-plus"></i>
          </a>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Label</th>
              <th>Background Type</th>
              <th>Visible</th>
              <th>Sort Order</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sections as $section)
              <tr>
                <td>{{ $section->name }}</td>
                <td>{{ $section->label }}</td>
                <td>{{ ucfirst($section->background_type) }}</td>
                <td>{!! $section->visible ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>' !!}</td>
                <td>{{ $section->sort_order }}</td>
                <td>
                  <a href="{{ route('admin.sections.fields.index', $section) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-list"></i>
                  </a>
                  <a href="{{ route('admin.pages.sections.edit', $section) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('admin.pages.sections.destroy', $section) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this section?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-end">
          {{ $sections->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

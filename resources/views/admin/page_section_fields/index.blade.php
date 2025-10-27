@extends('admin.default')

@section('content')

<!-- Page Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Fields — {{ $section->label ?? $section->name }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.pages.sections.index', [$section->page->id]) }}">{{ $section->page->name }}</a></li>
          <li class="breadcrumb-item active">{{ $section->label ?? $section->name }}</li>
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
          <h3 class="card-title mb-0">Fields — {{ $section->label ?? $section->name }}</h3>
          <a class="btn btn-primary" href="{{ route('admin.sections.fields.create', $section) }}">
            <i class="fas fa-solid fa-plus"></i>
          </a>
        </div>
      </div>
      <div class="card-body p-0">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Field Name</th>
              <th>Label</th>
              <th>Type</th>
              <th>Sort</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($fields as $field)
              <tr>
                <td>{{ $field->id }}</td>
                <td>{{ $field->field_name }}</td>
                <td>{{ $field->field_label }}</td>
                <td><span class="badge bg-info">{{ ucfirst($field->field_type) }}</span></td>
                <td>{{ $field->sort_order }}</td>
                <td>
                  <a href="{{ route('admin.sections.fields.edit', $field->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                  <form action="{{ route('admin.sections.fields.destroy', $field->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this field?')">
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
          {{ $fields->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

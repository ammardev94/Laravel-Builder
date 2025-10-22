@extends('admin.default')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="m-0">Fields — {{ $section->label ?? $section->name }}</h1>
      <a href="{{ route('admin.sections.fields.create', $section) }}" class="btn btn-primary">
        <i class="fas fa-plus"></i>
      </a>
    </div>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
      <div class="card-body">
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

        <div class="mt-3">
          {{ $fields->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

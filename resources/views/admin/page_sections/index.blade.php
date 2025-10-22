@extends('admin.default')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="m-0">Sections — {{ $page->name }}</h1>
      <a href="{{ route('admin.pages.sections.create', $page) }}" class="btn btn-primary">
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
              <th>#</th>
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
                <td>{{ $section->id }}</td>
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

        <div class="mt-3">
          {{ $sections->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

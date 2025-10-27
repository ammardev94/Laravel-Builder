@extends('admin.default')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="m-0">Pages</h1>
      <a href="{{ route('admin.pages.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
    </div>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Slug</th>
              <th>Status</th>
              <th>Type</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pages as $page)
              <tr>
                <td>{{ $page->name }}</td>
                <td>{{ $page->slug }}</td>
                <td>{!! $page->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Inactive</span>' !!}</td>
                <td>{{ ucfirst($page->type) }}</td>
                <td>
                  <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                  <a href="{{ route('admin.pages.sections.index', $page) }}" class="btn btn-sm btn-info"><i class="fas fa-layer-group"></i></a>
                  <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this page?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="mt-3">
          {{ $pages->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@extends('admin.default')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add New Page</h1>
      </div>
      <div class="col-sm-6 text-right">
        <a href="{{ route('admin.pages.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create Page</h3>
      </div>

      <form action="{{ route('admin.pages.store') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter page name" required>
                </div>
      
                <div class="col-md-6 form-group">
                  <label for="slug">Slug</label>
                  <input type="text" name="slug" class="form-control" placeholder="page-slug" required>
                </div>
      
                <div class="col-md-6 form-group">
                  <label for="title">Title</label>
                  <input type="text" name="title" class="form-control" placeholder="Page title">
                </div>
      
                <div class="col-md-6 form-group">
                  <label for="canonical_url">Canonical URL</label>
                  <input type="url" name="canonical_url" class="form-control" placeholder="https://example.com/page">
                </div>
      
                <div class="col-md-6 form-group">
                  <label for="visibility">Visibility</label>
                  <select name="visibility" class="form-control">
                    <option value="no-index">No Index</option>
                    <option value="no-follow">No Follow</option>
                  </select>
                </div>
      
                <div class="col-md-6 form-group">
                  <label for="type">Type</label>
                  <select name="type" class="form-control">
                    <option value="0">Static</option>
                    <option value="1">Dynamic</option>
                  </select>
                </div>
      
                <!-- ✅ Custom AdminLTE checkbox for Published -->
                <div class="col-md-6 form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="status" name="status" value="1" checked>
                    <label for="status" class="custom-control-label">Published</label>
                  </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i>
                Save
            </button>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i> Cancel</a>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection

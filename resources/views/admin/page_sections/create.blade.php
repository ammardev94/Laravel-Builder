@extends('admin.default')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="card card-primary">

      <div class="card-header">
        <h3 class="card-title">Add Section — {{ $page->name }}</h3>
      </div>

      <form action="{{ route('admin.pages.sections.store', $page) }}" method="POST">
        @csrf
        <div class="card-body">
          <div class="row">

            <div class="col-md-6 form-group mb-3">
              <label>Name *</label>
              <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
              @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
  
            <div class="col-md-6 form-group mb-3">
              <label>Label</label>
              <input type="text" name="label" value="{{ old('label') }}" class="form-control">
            </div>
  
            <div class="col-md-6 form-group mb-3">
              <label>Background Type</label>
              <select name="background_type" class="form-control">
                <option value="none">None</option>
                <option value="image">Image</option>
                <option value="video">Video</option>
                <option value="color">Color</option>
              </select>
            </div>
  
            <div class="col-md-6 form-group mb-3">
              <label>Background Value</label>
              <input type="text" name="background_value" value="{{ old('background_value') }}" class="form-control">
            </div>
  
            <div class="col-md-6 form-group mb-3">
              <label>Sort Order</label>
              <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control">
            </div>
  
            <div class="col-md-6 form-group">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="visible" name="visible" value="1" checked>
                <label for="status" class="custom-control-label">Visible</label>
              </div>
            </div>
          </div>
        </div>
      </form>
      
      <div class="card-footer">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
        <a href="{{ route('admin.pages.sections.index', $page) }}" class="btn btn-secondary">
            <i class="fas fa-times-circle"></i> 
            Cancel
        </a>
      </div>

    </div>
  </div>
</div>
@endsection

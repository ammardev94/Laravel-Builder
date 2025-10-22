@extends('admin.default')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Section — {{ $section->label ?? $section->name }}</h3>
      </div>
      <form action="{{ route('admin.pages.sections.update', $section) }}" method="POST">
        @csrf @method('PUT')
        <div class="card-body">

          <div class="row">

            <div class="col-md-6 form-group mb-3">
              <label>Name *</label>
              <input type="text" name="name" value="{{ old('name', $section->name) }}" class="form-control @error('name') is-invalid @enderror">
              @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
  
            <div class="col-md-6 form-group mb-3">
              <label>Label</label>
              <input type="text" name="label" value="{{ old('label', $section->label) }}" class="form-control">
            </div>
  
            <div class="col-md-6 form-group mb-3">
              <label>Background Type</label>
              <select name="background_type" class="form-control">
                @foreach(['none','image','video','color'] as $type)
                  <option value="{{ $type }}" {{ $section->background_type === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                @endforeach
              </select>
            </div>
  
            <div class="col-md-6 form-group mb-3">
              <label>Background Value</label>
              <input type="text" name="background_value" value="{{ old('background_value', $section->background_value) }}" class="form-control">
            </div>
  
            <div class="col-md-6 form-group mb-3">
              <label>Sort Order</label>
              <input type="number" name="sort_order" value="{{ old('sort_order', $section->sort_order) }}" class="form-control">
            </div>
  

            <div class="col-md-6 form-group mb-3">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="visible" name="visible" value="1" {{ $section->visible ? 'checked' : '' }}>
                <label for="status" class="custom-control-label">Visible</label>
              </div>
            </div>


          </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
          <a href="{{ route('admin.pages.sections.index', $page) }}" class="btn btn-secondary">
              <i class="fas fa-times-circle"></i> 
              Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

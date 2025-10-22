@extends('admin.default')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add Field — {{ $section->label ?? $section->name }}</h3>
      </div>
        <form action="{{ route('admin.sections.fields.store', $section) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                    <label>Field Name *</label>
                    <input type="text" name="field_name" value="{{ old('field_name') }}" class="form-control @error('field_name') is-invalid @enderror">
                    @error('field_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
        
                    <div class="col-md-6 form-group mb-3">
                    <label>Label</label>
                    <input type="text" name="field_label" value="{{ old('field_label') }}" class="form-control">
                    </div>
        
                    <div class="col-md-6 form-group mb-3">
                    <label>Type *</label>
                    <select name="field_type" class="form-control">
                        @foreach(['text','textarea','file','link','video','image'] as $type)
                        <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                    </div>
        
                    <div class="col-md-6 form-group mb-3">
                    <label>Value</label>
                    <textarea name="field_value" rows="3" class="form-control">{{ old('field_value') }}</textarea>
                    </div>
        
                    <div class="col-md-6 form-group mb-3">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i>
                    Save
                </button>
                <a href="{{ route('admin.sections.fields.index', $section) }}" class="btn btn-default">
                <i class="fas fa-times-circle"></i> 
                Cancel
                </a>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection

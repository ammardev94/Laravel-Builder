@extends('admin.default')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="card card-primary">

      <div class="card-header">
        <h3 class="card-title">Add Section — {{ $page->name }}</h3>
      </div>

      <form action="{{ route('admin.pages.sections.store', $page) }}" 
            method="POST" 
            enctype="multipart/form-data">
        @csrf

        {{-- Show global validation errors --}}
        @if ($errors->any())
          <div class="alert alert-danger mx-3 mt-3">
            <h5><i class="icon fas fa-exclamation-triangle"></i> Please fix the following errors:</h5>
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif


        <div class="card-body">
          <div class="row">

            {{-- Name --}}
            <div class="col-md-6 form-group mb-3">
              <label>Name *</label>
              <input type="text" 
                     name="name" 
                     value="{{ old('name') }}" 
                     class="form-control @error('name') is-invalid @enderror">
              @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            {{-- Label --}}
            <div class="col-md-6 form-group mb-3">
              <label>Label</label>
              <input type="text" 
                     name="label" 
                     value="{{ old('label') }}" 
                     class="form-control @error('label') is-invalid @enderror">
              @error('label') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            {{-- Background Type --}}
            <div class="col-md-6 form-group mb-3">
              <label>Background Type *</label>
              <select name="background_type" id="background_type" 
                      class="form-control @error('background_type') is-invalid @enderror">
                <option value="none" {{ old('background_type') == 'none' ? 'selected' : '' }}>None</option>
                <option value="image" {{ old('background_type') == 'image' ? 'selected' : '' }}>Image</option>
                <option value="video" {{ old('background_type') == 'video' ? 'selected' : '' }}>Video</option>
                <option value="color" {{ old('background_type') == 'color' ? 'selected' : '' }}>Color</option>
              </select>
              @error('background_type') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            {{-- Background Value --}}
            <div class="col-md-6 form-group mb-3" id="background-value-wrapper">
              <label>Background Value</label>

              {{-- Text/Color --}}
              <input type="text" 
                     name="background_value" 
                     id="background_value_text" 
                     value="{{ old('background_value') }}" 
                     class="form-control @error('background_value') is-invalid @enderror">
              @error('background_value') <span class="invalid-feedback">{{ $message }}</span> @enderror

              {{-- File Input (hidden by default) --}}
              <input type="file" 
                     name="background_file" 
                     id="background_file" 
                     class="form-control d-none @error('background_file') is-invalid @enderror" 
                     accept="image/*,video/*">
              @error('background_file') <span class="invalid-feedback">{{ $message }}</span> @enderror

              {{-- Preview Container --}}
              <div id="background-preview" class="mt-3"></div>
            </div>

            {{-- Sort Order --}}
            <div class="col-md-6 form-group mb-3">
              <label>Sort Order</label>
              <input type="number" 
                     name="sort_order" 
                     value="{{ old('sort_order', 0) }}" 
                     class="form-control @error('sort_order') is-invalid @enderror">
              @error('sort_order') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            {{-- Visible Checkbox --}}
            <div class="col-md-6 form-group">
              <div class="custom-control custom-checkbox mt-4">
                <input class="custom-control-input" 
                       type="checkbox" 
                       id="visible" 
                       name="visible" 
                       value="1" 
                       {{ old('visible', true) ? 'checked' : '' }}>
                <label for="visible" class="custom-control-label">Visible</label>
              </div>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Save
          </button>
          <a href="{{ route('admin.pages.sections.index', $page) }}" class="btn btn-secondary">
            <i class="fas fa-times-circle"></i> Cancel
          </a>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const bgType = document.getElementById('background_type');
    const textInput = document.getElementById('background_value_text');
    const fileInput = document.getElementById('background_file');
    const preview = document.getElementById('background-preview');

    function resetInputs() {
        textInput.classList.add('d-none');
        fileInput.classList.add('d-none');
        preview.innerHTML = '';
    }

    function showTextInput() {
        resetInputs();
        textInput.type = 'text';
        textInput.classList.remove('d-none');
    }

    function showColorInput() {
        resetInputs();
        textInput.type = 'color';
        textInput.classList.remove('d-none');
    }

    function showFileInput(type) {
        resetInputs();
        fileInput.classList.remove('d-none');
        fileInput.accept = type === 'image' ? 'image/*' : 'video/*';
    }

    function handleChange() {
        const type = bgType.value;
        preview.innerHTML = '';
        if (type === 'image') {
            showFileInput('image');
        } else if (type === 'video') {
            showFileInput('video');
        } else if (type === 'color') {
            showColorInput();
        } else {
            resetInputs();
        }
    }

    fileInput.addEventListener('change', function(e) {
        preview.innerHTML = '';
        const file = e.target.files[0];
        if (!file) return;

        const type = bgType.value;
        const url = URL.createObjectURL(file);

        if (type === 'image') {
            const img = document.createElement('img');
            img.src = url;
            img.className = 'img-thumbnail mt-2';
            img.style.maxWidth = '250px';
            preview.appendChild(img);
        } else if (type === 'video') {
            const video = document.createElement('video');
            video.src = url;
            video.controls = true;
            video.className = 'mt-2';
            video.style.maxWidth = '320px';
            preview.appendChild(video);
        }
    });

    bgType.addEventListener('change', handleChange);
    handleChange();
});
</script>
@endsection
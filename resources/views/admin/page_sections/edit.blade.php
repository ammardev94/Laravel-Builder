@extends('admin.default')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Section — {{ $section->label ?? $section->name }}</h3>
      </div>

      <form action="{{ route('admin.pages.sections.update', [$section->id]) }}" 
            method="POST" 
            enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                     value="{{ old('name', $section->name) }}" 
                     class="form-control @error('name') is-invalid @enderror" required>
              @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            {{-- Label --}}
            <div class="col-md-6 form-group mb-3">
              <label>Label</label>
              <input type="text" 
                     name="label" 
                     value="{{ old('label', $section->label) }}" 
                     class="form-control @error('label') is-invalid @enderror">
              @error('label') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            {{-- Background Type --}}
            <div class="col-md-6 form-group mb-3">
              <label>Background Type *</label>
              <select name="background_type" id="background_type" 
                      class="form-control @error('background_type') is-invalid @enderror" required>
                @foreach(['none','image','video','color'] as $type)
                  <option value="{{ $type }}" 
                    {{ old('background_type', $section->background_type) == $type ? 'selected' : '' }}>
                    {{ ucfirst($type) }}
                  </option>
                @endforeach
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
                     value="{{ old('background_value', $section->background_value) }}" 
                     class="form-control @error('background_value') is-invalid @enderror 
                     {{ in_array(old('background_type', $section->background_type), ['image','video']) ? 'd-none' : '' }}">
              @error('background_value') <span class="invalid-feedback">{{ $message }}</span> @enderror

              {{-- File Input --}}
              <input type="file" 
                     name="background_file" 
                     id="background_file" 
                     class="form-control @error('background_file') is-invalid @enderror 
                     {{ in_array(old('background_type', $section->background_type), ['image','video']) ? '' : 'd-none' }}" 
                     accept="image/*,video/*">
              @error('background_file') <span class="invalid-feedback">{{ $message }}</span> @enderror

              {{-- Preview --}}
              <div id="background-preview" class="mt-3">
                @if($section->background_type === 'image' && $section->background_value)
                  <img src="{{ asset('storage/'.$section->background_value) }}" 
                       alt="Current Image" class="img-thumbnail mt-2" style="max-width: 250px;">
                @elseif($section->background_type === 'video' && $section->background_value)
                  <video src="{{ asset('storage/'.$section->background_value) }}" 
                         controls class="mt-2" style="max-width: 320px;"></video>
                @elseif($section->background_type === 'color' && $section->background_value)
                  <div class="mt-2" 
                       style="width: 80px; height: 30px; border: 1px solid #ddd; background: {{ $section->background_value }}"></div>
                @endif
              </div>
            </div>

            {{-- Sort Order --}}
            <div class="col-md-6 form-group mb-3">
              <label>Sort Order</label>
              <input type="number" 
                     name="sort_order" 
                     value="{{ old('sort_order', $section->sort_order ?? 0) }}" 
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
                       {{ old('visible', $section->visible) ? 'checked' : '' }}>
                <label for="visible" class="custom-control-label">Visible</label>
              </div>
            </div>

          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Save
          </button>
          <a href="{{ route('admin.pages.sections.index', $section->page_id) }}" class="btn btn-secondary">
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

    function showTextOrColorInput(type) {
        textInput.classList.remove('d-none');
        fileInput.classList.add('d-none');
        textInput.type = (type === 'color') ? 'color' : 'text';
    }

    function showFileInput(type) {
        textInput.classList.add('d-none');
        fileInput.classList.remove('d-none');
        fileInput.accept = type === 'image' ? 'image/*' : 'video/*';
    }

    function updateVisibility(clearPreview = false) {
        const type = bgType.value;
        if (clearPreview) preview.innerHTML = '';

        if (type === 'image' || type === 'video') {
            showFileInput(type);
        } else {
            showTextOrColorInput(type);
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

    bgType.addEventListener('change', () => updateVisibility(true));

    updateVisibility(false);
});
</script>
@endsection

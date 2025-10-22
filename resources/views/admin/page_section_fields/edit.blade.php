@extends('admin.default')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Field — {{ $section->label ?? $section->name }}</h3>
      </div>

      <form action="{{ route('admin.sections.fields.update', [$field->id]) }}" 
            method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card-body">
          <div class="row">

            {{-- Field Name --}}
            <div class="col-md-6 form-group mb-3">
              <label>Field Name *</label>
              <input type="text" 
                     name="field_name" 
                     value="{{ old('field_name', $field->field_name) }}" 
                     class="form-control @error('field_name') is-invalid @enderror" 
                     required>
              @error('field_name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror
            </div>

            {{-- Field Label --}}
            <div class="col-md-6 form-group mb-3">
              <label>Label</label>
              <input type="text" 
                     name="field_label" 
                     value="{{ old('field_label', $field->field_label) }}" 
                     class="form-control @error('field_label') is-invalid @enderror">
              @error('field_label')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror
            </div>

            {{-- Field Type --}}
            <div class="col-md-6 form-group mb-3">
              <label>Type *</label>
              <select name="field_type" id="field_type" 
                      class="form-control @error('field_type') is-invalid @enderror" required>
                <option value="">Select Type</option>
                @foreach(['text','textarea','file','link','video','image'] as $type)
                  <option value="{{ $type }}" {{ old('field_type', $field->field_type) == $type ? 'selected' : '' }}>
                    {{ ucfirst($type) }}
                  </option>
                @endforeach
              </select>
              @error('field_type')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror
            </div>

            {{-- Field Value --}}
            <div class="col-md-6 form-group mb-3" id="value-wrapper">
              <label>Value</label>

              {{-- Textarea --}}
              <textarea name="field_value" id="field_value" rows="3" 
                        class="form-control @error('field_value') is-invalid @enderror {{ in_array(old('field_type', $field->field_type), ['file','image','video']) ? 'd-none' : '' }}">{{ old('field_value', $field->field_value) }}</textarea>
              @error('field_value')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror

              {{-- File input --}}
              <input type="file" 
                     name="value_file" 
                     id="field_value_file" 
                     class="form-control @error('value_file') is-invalid @enderror {{ in_array(old('field_type', $field->field_type), ['file','image','video']) ? '' : 'd-none' }}" 
                     accept="image/*,video/*,application/pdf">
              @error('value_file')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror

              {{-- Preview --}}
              <div id="preview-container" class="mt-2">
                @if($field->field_type === 'image' && $field->field_value)
                  <img src="{{ asset('storage/'.$field->field_value) }}" 
                       alt="Current Image" class="img-thumbnail mt-2" style="max-width: 250px;">
                @elseif($field->field_type === 'video' && $field->field_value)
                  <video src="{{ asset('storage/'.$field->field_value) }}" 
                         controls class="mt-2" style="max-width: 320px;"></video>
                @elseif($field->field_type === 'file' && $field->field_value)
                  <p class="mt-2">
                    <a href="{{ asset('storage/'.$field->field_value) }}" target="_blank">
                    </a>
                  </p>
                @endif
              </div>
            </div>

            {{-- Sort Order --}}
            <div class="col-md-6 form-group mb-3">
              <label>Sort Order</label>
              <input type="number" 
                     name="sort_order" 
                     value="{{ old('sort_order', $field->sort_order ?? 0) }}" 
                     class="form-control @error('sort_order') is-invalid @enderror">
              @error('sort_order')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
              @enderror
            </div>

          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Save
          </button>
          <a href="{{ route('admin.sections.fields.index', $section) }}" class="btn btn-default">
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
    const fieldType = document.getElementById('field_type');
    const textArea = document.getElementById('field_value');
    const fileInput = document.getElementById('field_value_file');
    const previewContainer = document.getElementById('preview-container');

    function showTextarea() {
        textArea.classList.remove('d-none');
        textArea.style.display = '';
        if (fileInput) fileInput.classList.add('d-none');
    }

    function showFileInput() {
        textArea.classList.add('d-none');
        textArea.style.display = 'none';
        if (fileInput) fileInput.classList.remove('d-none');
    }

    function updateFieldVisibility() {
        const type = fieldType.value;
        if (['file', 'image', 'video'].includes(type)) {
            showFileInput();
            if (type === 'image') {
                fileInput.setAttribute('accept', 'image/*');
            } else if (type === 'video') {
                fileInput.setAttribute('accept', 'video/*');
            } else {
                fileInput.setAttribute('accept', 'image/*,video/*,application/pdf');
            }
        } else {
            showTextarea();
        }
    }

    // Preview for new upload
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            previewContainer.innerHTML = '';
            const file = e.target.files[0];
            if (!file) return;

            const type = fieldType.value;
            const url = URL.createObjectURL(file);

            if (type === 'image') {
                const img = document.createElement('img');
                img.src = url;
                img.className = 'img-thumbnail mt-2';
                img.style.maxWidth = '250px';
                previewContainer.appendChild(img);
            } else if (type === 'video') {
                const video = document.createElement('video');
                video.src = url;
                video.controls = true;
                video.className = 'mt-2';
                video.style.maxWidth = '320px';
                previewContainer.appendChild(video);
            } else {
                const p = document.createElement('p');
                p.className = 'mt-2';
                p.textContent = `Selected file: ${file.name} (${(file.size/1024).toFixed(1)} KB)`;
                previewContainer.appendChild(p);
            }
        });
    }

    fieldType.addEventListener('change', updateFieldVisibility);
    updateFieldVisibility();
});
</script>
@endsection

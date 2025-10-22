@extends('admin.default')

@section('css')
    <style>
        .error {
            color: red;
            font-size: 0.875em;
        }
        .is-invalid {
            border-color: #dc3545;
        }
        .is-valid {
            border-color: #28a745;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
        }
    </style>
@endsection

@section('content')

<!-- Page Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add Course</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.courses.index') }}">Courses</a></li>
          <li class="breadcrumb-item active">Add Course</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Content -->
<div class="content">
  <div class="container-fluid">
    @include('include.messages')
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title mb-0">Add Course</h3>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.courses.store') }}" method="POST" id="addCourseForm" class="form-inline">
          @csrf
          
          <div class="form-group mr-2 mb-2">
            <label class="mr-2" for="name">Name</label>
            <input type="text" 
                   name="name"
                   id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Enter course name"
                   value="{{ old('name') }}"
                   required 
                   minlength="3">
            @error('name')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group mb-2">
            <button type="submit" class="btn btn-primary mr-2">
              <i class="fas fa-save"></i> Save
            </button>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-default">
              <i class="fas fa-times-circle"></i> Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')

<script>
    document.getElementById('img').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const preview = document.getElementById('img-preview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        } else {
            preview.classList.add('d-none');
        }
    });
</script>

<script>
    $(document).ready(function () {
        $('#addCourseForm').validate({
            rules: {
                name: { required: true, minlength: 3 },
            },
            messages: {
                name: "Please enter course name (at least 3 characters)",
            },
            errorElement: "label",
            validClass: "is-valid",
            errorClass: "is-invalid text-danger",
            highlight: function (element, errorClass, validClass) {
                $(element).addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass(errorClass).addClass(validClass);
            }
        });
    });
</script>
@endsection

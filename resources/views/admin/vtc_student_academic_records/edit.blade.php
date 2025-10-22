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
        <h1 class="m-0">Edit Academic Record</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.vtc_student_academic_records.index') }}">Academic Records</a></li>
          <li class="breadcrumb-item active">Edit Academic Record</li>
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
        <h3 class="card-title">Edit Academic Record</h3>
      </div>

      <form action="{{ route('admin.vtc_student_academic_records.update', $academicRecord->id) }}" method="POST" id="editAcademicRecordForm">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">

            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="vtc_student_id">Student</label>
                <select name="vtc_student_id" id="vtc_student_id" class="form-control select2" required>
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ (old('vtc_student_id', $academicRecord->vtc_student_id) == $student->id) ? 'selected' : '' }}>
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('vtc_student_id') }}</div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="qualification">Degree / Certification</label>
                <input id="qualification" type="text" name="qualification" class="form-control"
                       placeholder="Enter degree or certification"
                       value="{{ old('qualification', $academicRecord->qualification) }}" required>
                <div class="invalid-feedback">{{ $errors->first('qualification') }}</div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="institute_name">Institute</label>
                <input id="institute_name" type="text" name="institute_name" class="form-control"
                       placeholder="Enter institute name"
                       value="{{ old('institute_name', $academicRecord->institute_name) }}" required>
                <div class="invalid-feedback">{{ $errors->first('institute_name') }}</div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="year">Passing Year</label>
                <input id="year" type="number" name="year" class="form-control"
                       placeholder="YYYY"
                       value="{{ old('year', $academicRecord->year) }}" required min="1900" max="{{ date('Y') }}">
                <div class="invalid-feedback">{{ $errors->first('year') }}</div>
              </div>
            </div>

          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Update</button>
          <a href="{{ route('admin.vtc_student_academic_records.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: 'Select Student',
            allowClear: true
        });

        $('#editAcademicRecordForm').validate({
            rules: {
                vtc_student_id: { required: true },
                qualification: { required: true, minlength: 2 },
                institute_name: { required: true, minlength: 2 },
                year: { required: true, digits: true, minlength: 4, maxlength: 4 },
            },
            messages: {
                vtc_student_id: "Please select a student",
                qualification: "Please enter degree/certification",
                institute_name: "Please enter institute name",
                year: "Please enter a valid year"
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

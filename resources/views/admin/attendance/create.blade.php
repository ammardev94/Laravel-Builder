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

        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 6px 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
        }

    </style>
@endsection


@section('content')
<!-- Page Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add Attendance</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.attendance.index') }}">Attendance</a></li>
          <li class="breadcrumb-item active">Add</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Content -->
<div class="content">
  <div class="container-fluid">
    @include('include.messages')

    <div class="row">
        <div class="col-md-12 col-sm-12">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Family Service</h3>
              </div>
              <form action="{{ route('admin.attendance.store') }}" method="POST" id="addAttendanceForm">
                @csrf
                <div class="card-body">
                  <div class="row">
          
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
                      <label for="student_id">Student</label>
                      <select id="student_id" name="student_id" class="form-control" required>
                        <option value="">Select student</option>
                        @foreach($students as $student)
                          <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                            {{ $student->stu_full_name }}
                          </option>
                        @endforeach
                      </select>
                      @error('student_id')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
          
                    <div class="col-md-6 mb-3">
                      <label for="class">Class</label>
                      <input type="text" name="class" class="form-control" placeholder="Enter class" value="{{ old('class') }}" required>
                      @error('class')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
          
                    <div class="col-md-6 mb-3">
                      <label for="date">Date</label>
                      <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
                      @error('date')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
          
                    <div class="col-md-6 mb-3">
                      <label for="attendance">Attendance</label>
                      <select name="attendance" class="form-control" required>
                        <option value="">Select attendance</option>
                        <option value="P" {{ old('attendance') == 'P' ? 'selected' : '' }}>Present</option>
                        <option value="a" {{ old('attendance') == 'a' ? 'selected' : '' }}>Absent</option>
                      </select>
                      @error('attendance')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
          
                  </div>
                </div>
          
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                  <a href="{{ route('admin.attendance.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i> Cancel</a>
                </div>
              </form>
            </div>
            
        </div>
    </div>


  </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function () {

    $('#student_id').select2({ placeholder: 'Select Student' });

    $('#addAttendanceForm').validate({
        rules: {
            student_id: { required: true },
            class: { required: true, minlength: 2, maxlength: 10 },
            date: { required: true, date: true },
            attendance: { required: true }
        },
        messages: {
            student_id: "Please select a student",
            class: {
            required: "Class is required",
            minlength: "Class must be at least 2 characters"
            },
            date: "Please enter a valid date",
            attendance: "Please select attendance status"
        },
        errorElement: 'div',
        errorClass: 'text-danger',
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>
@endsection

@extends('admin.default')

@section('content')
<!-- Page Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Attendance</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.attendance.index') }}">Attendance</a></li>
          <li class="breadcrumb-item active">Edit</li>
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
        <h3 class="card-title">Edit Attendence</h3>
        </div>

        <form action="{{ route('admin.attendance.update', [$attendance->student_id, $attendance->class, $attendance->date]) }}" method="POST">
            @csrf
            @method('PUT')
    
          <div class="card-body">
            <div class="row">
    
              <div class="col-md-6 mb-3">
                <label for="student_id">Student</label>
                <select name="student_id" class="form-control" required>
                  <option value="">Select student</option>
                  @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ (old('student_id', $attendance->student_id) == $student->id) ? 'selected' : '' }}>
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
                <input type="text" name="class" class="form-control" placeholder="Enter class" value="{{ old('class', $attendance->class) }}" required>
                @error('class')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="col-md-6 mb-3">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', $attendance->date) }}" required>
                @error('date')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="col-md-6 mb-3">
                <label for="attendance">Attendance</label>
                <select name="attendance" class="form-control" required>
                  <option value="">Select attendance</option>
                  <option value="P" {{ old('attendance', $attendance->attendance) == 'P' ? 'selected' : '' }}>Present</option>
                  <option value="a" {{ old('attendance', $attendance->attendance) == 'a' ? 'selected' : '' }}>Absent</option>
                </select>
                @error('attendance')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
    
            </div>
          </div>
    
          <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
            <a href="{{ route('admin.attendance.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i> Cancel</a>
          </div>
        </form>
    </div>

  </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function () {
  $('#editAttendanceForm').validate({
    rules: {
      student_id: { required: true },
      class: { required: true, minlength: 2 },
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

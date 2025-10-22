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
        <h1 class="m-0">Edit VTC Attendance</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.vtc_attendance.index') }}">VTC Attendance</a></li>
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
          <h3 class="card-title">Edit Attendance Record</h3>
        </div>

        <form action="{{ route('admin.vtc_attendance.update', $attendance->id) }}" method="POST" id="editVtcAttendanceForm">
            @csrf
            @method('PUT')

            <div class="card-body">
              <div class="row">

                <div class="col-md-6 mb-3">
                  <label for="vtc_student_id">Student</label>
                  <select id="vtc_student_id" name="vtc_student_id" class="form-control" required>
                    <option value="">Select student</option>
                    @foreach($students as $student)
                      <option value="{{ $student->id }}" {{ old('vtc_student_id', $attendance->vtc_student_id) == $student->id ? 'selected' : '' }}>
                        {{ $student->name }} (GR No: {{ $student->gr_no }})
                      </option>
                    @endforeach
                  </select>
                  @error('vtc_student_id')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="gr_no">GR No</label>
                  <input type="text" name="gr_no" id="gr_no" class="form-control" value="{{ old('gr_no', $attendance->gr_no) }}" placeholder="Enter GR No" required>
                  @error('gr_no')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="date">Date</label>
                  <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $attendance->date) }}" required>
                  @error('date')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="col-md-6 mb-3">
                  <label for="attendence">Attendance</label>
                  <select name="attendence" id="attendence" class="form-control" required>
                    <option value="">Select Attendance</option>
                    <option value="present" {{ old('attendence', $attendance->attendence) == 'present' ? 'selected' : '' }}>Present</option>
                    <option value="absent" {{ old('attendence', $attendance->attendence) == 'absent' ? 'selected' : '' }}>Absent</option>
                  </select>
                  @error('attendence')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>

              </div>
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
              <a href="{{ route('admin.vtc_attendance.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i> Cancel</a>
            </div>
        </form>
    </div>

  </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function () {
    $('#vtc_student_id').select2({ placeholder: 'Select Student' });

    $('#editVtcAttendanceForm').validate({
        rules: {
            vtc_student_id: { required: true },
            gr_no: { required: true },
            date: { required: true, date: true },
            attendence: { required: true }
        },
        messages: {
            vtc_student_id: "Please select a student",
            gr_no: "Please enter GR No",
            date: "Please enter a valid date",
            attendence: "Please select attendance status"
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

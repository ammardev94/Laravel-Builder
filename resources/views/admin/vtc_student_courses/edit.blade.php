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
<div class="content">
    <div class="container-fluid">
        @include('include.messages')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title mb-0">Edit Assigned Course</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.vtc_student_courses.update', $vtcStudentCourse->id) }}" 
                      method="POST" 
                      id="editCourseForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Student --}}
                            <div class="form-group">
                                <label for="vtc_student_id">Select Student</label>
                                <select name="vtc_student_id" id="vtc_student_id" 
                                        class="form-control select2 @error('vtc_student_id') is-invalid @enderror">
                                    <option value="">-- Select Student --</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" 
                                            {{ old('vtc_student_id', $vtcStudentCourse->vtc_student_id) == $student->id ? 'selected' : '' }}>
                                            {{ $student->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('vtc_student_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- Course --}}
                            <div class="form-group">
                                <label for="course_id">Select Course</label>
                                <select name="course_id" id="course_id" 
                                        class="form-control select2 @error('course_id') is-invalid @enderror">
                                    <option value="">-- Select Course --</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" 
                                            {{ old('course_id', $vtcStudentCourse->course_id) == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('admin.vtc_student_courses.index') }}" class="btn btn-default">
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
    $(document).ready(function () {
        $('#vtc_student_id').select2({
            theme: 'bootstrap4',
            placeholder: "Select Student",
            allowClear: true
        });

        $('#course_id').select2({
            theme: 'bootstrap4',
            placeholder: "Select Course",
            allowClear: true
        });

        $('#editCourseForm').validate({
            rules: {
                vtc_student_id: {
                    required: true
                },
                course_id: {
                    required: true
                }
            },
            messages: {
                vtc_student_id: {
                    required: "Please select a student"
                },
                course_id: {
                    required: "Please select a course"
                }
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

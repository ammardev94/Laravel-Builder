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
                <h1 class="m-0">Edit Student Service</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.student_services.index') }}">Student Services</a></li>
                    <li class="breadcrumb-item active">Edit Student Service</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="content">
    <div class="container-fluid">
        @include('include.messages')

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Student Service</h3>
            </div>

            <form action="{{ route('admin.student_services.update', $studentService->id) }}" method="POST" id="editStudentServiceForm">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <!-- Student -->
                        <div class="col-md-6 mb-3">
                            <label for="student_id">Student</label>
                            <select name="student_id" id="student_id" class="form-control" required>
                                <option value="">Select Student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" {{ $studentService->student_id == $student->id ? 'selected' : '' }}>
                                        {{ $student->stu_full_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('student_id') }}</div>
                        </div>

                        <!-- Service -->
                        <div class="col-md-6 mb-3">
                            <label for="service">Service</label>
                            <input type="text" name="service" id="service" class="form-control" placeholder="Enter service" value="{{ old('service', $studentService->service) }}" required>
                            <div class="invalid-feedback">{{ $errors->first('service') }}</div>
                        </div>

                        <!-- Date -->
                        <div class="col-md-6 mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', \Carbon\Carbon::parse($studentService->date)->format('Y-m-d')) }}" required>
                            <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                    <a href="{{ route('admin.student_services.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#student_id').select2({ placeholder: 'Select Student' });

        $.validator.addMethod("noFutureDate", function (value, element) {
            let now = new Date().setHours(0, 0, 0, 0);
            let input = new Date(value).setHours(0, 0, 0, 0);
            return this.optional(element) || input <= now;
        }, "Date cannot be in the future");

        $('#editStudentServiceForm').validate({
            rules: {
                student_id: { required: true },
                service: { required: true, minlength: 3 },
                date: { required: true, date: true, noFutureDate: true }
            },
            messages: {
                student_id: "Please select a student",
                service: {
                    required: "Please enter a service name",
                    minlength: "Service must be at least 3 characters"
                },
                date: {
                    required: "Please enter a date",
                    noFutureDate: "Date cannot be in the future"
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

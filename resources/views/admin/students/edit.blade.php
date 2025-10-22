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
                <h1 class="m-0">Edit Student</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
                    <li class="breadcrumb-item active">Edit Student</li>
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
                <h3 class="card-title">Edit Student</h3>
            </div>

            <form action="{{ route('admin.students.update', $student->id) }}" method="POST" id="editStudentForm">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="stu_full_name">Full Name</label>
                            <input type="text" name="stu_full_name" class="form-control" placeholder="Enter full name" value="{{ old('stu_full_name', $student->stu_full_name) }}" required minlength="3">
                            <div class="invalid-feedback">{{ $errors->first('stu_full_name') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stu_dob">DOB</label>
                            <input type="date" name="stu_dob" class="form-control" value="{{ old('stu_dob', $student->stu_dob) }}" required>
                            <div class="invalid-feedback">{{ $errors->first('stu_dob') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="gr_num">GR Number</label>
                            <input type="text" name="gr_num" class="form-control" placeholder="Enter GR number" value="{{ old('gr_num', $student->gr_num) }}" required>
                            <div class="invalid-feedback">{{ $errors->first('gr_num') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="auto_gr_num">Auto GR Number</label>
                            <input type="text" name="auto_gr_num" class="form-control" placeholder="Enter GR number" value="{{ old('auto_gr_num', $student->auto_gr_num) }}" required>
                            <div class="invalid-feedback">{{ $errors->first('auto_gr_num') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="class">Class</label>
                            <input type="text" name="class" class="form-control" placeholder="Enter class" value="{{ old('class', $student->class) }}" required>
                            <div class="invalid-feedback">{{ $errors->first('class') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stu_gender">Gender</label>
                            <select name="stu_gender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('stu_gender', $student->stu_gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('stu_gender', $student->stu_gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('stu_gender') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="donation_date">Donation Date</label>
                            <input 
                                type="date" 
                                name="donation_date" 
                                class="form-control"
                                value="{{ old('donation_date', \Carbon\Carbon::parse($student->donation_date)->format('Y-m-d')) }}" 
                                required 
                            />
                            <div class="invalid-feedback">{{ $errors->first('donation_date') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="donation_expiry">Donation Expiry</label>
                            <input 
                                type="date" 
                                name="donation_expiry" 
                                class="form-control"
                                value="{{ old('donation_expiry', \Carbon\Carbon::parse($student->donation_expiry)->format('Y-m-d')) }}" 
                                required
                            />
                            <div class="invalid-feedback">{{ $errors->first('donation_expiry') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="family_id">Family</label>
                            <select name="family_id" id="family_id" class="form-control" required>
                                <option value="">Select Family</option>
                                @foreach ($families as $family)
                                    <option value="{{ $family->id }}" {{ old('family_id', $student->family_id) == $family->id ? 'selected' : '' }}>
                                        {{ $family->father_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('family_id') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="donor_id">Donor</label>
                            <select name="donor_id" id="donor_id" class="form-control">
                                <option value="">Select Donor</option>
                                @foreach ($donors as $donor)
                                    <option value="{{ $donor->id }}" {{ old('donor_id', $student->donor_id) == $donor->id ? 'selected' : '' }}>
                                        {{ $donor->donor_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('donor_id') }}</div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                    <a href="{{ route('admin.students.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#family_id').select2({ placeholder: 'Select Family' });
        $('#donor_id').select2({ placeholder: 'Select Donor' });

        $.validator.addMethod("noFutureDate", function (value, element) {
            let now = new Date().setHours(0, 0, 0, 0);
            let input = new Date(value).setHours(0, 0, 0, 0);
            return this.optional(element) || input <= now;
        }, "Date cannot be in the future");

        $.validator.addMethod("futureDate", function (value, element) {
            const now = new Date();
            const inputDate = new Date(value);
            now.setHours(0, 0, 0, 0);
            return this.optional(element) || inputDate >= now;
        }, "Please select a present or future date");

        $.validator.addMethod("autoGrFormat", function (value, element) {
            return this.optional(element) || /^B-\d{12}$/.test(value);
        }, "Please enter a valid auto GR number in format B-XXXXXXXXXXXX");

        $('#editStudentForm').validate({
            rules: {
                stu_full_name: { required: true, minlength: 3 },
                gr_num: {
                    required: true,
                    digits: true,
                    minlength: 3,
                    maxlength: 3
                },
                auto_gr_num: {
                    required: true,
                    autoGrFormat: true
                },
                class: { required: true },
                stu_gender: { required: true },
                stu_dob: { required: true, date: true, noFutureDate: true },
                donation_date: { required: true, date: true, noFutureDate: true },
                donation_expiry: {
                    required: true,
                    futureDate: true
                },
                family_id: { required: true },
                donor_id: { required: true }
            },
            messages: {
                stu_full_name: "Please enter full name",
                gr_num: {
                    required: "Please enter GR number",
                    digits: "Only numeric values are allowed",
                    minlength: "GR number must be at least 3 digits",
                    maxlength: "GR number must not exceed 3 digits"
                },
                auto_gr_num: {
                    required: "Please enter the auto GR number",
                    autoGrFormat: "Format must be B- followed by 12 digits (e.g. B-230518040952)"
                },
                class: "Please enter class",
                stu_gender: "Please select gender",
                stu_dob: {
                    required: "Please enter date of birth",
                    noFutureDate: "Date of birth can't be in the future"
                },
                donation_date: {
                    required: "Please enter donation date",
                    noFutureDate: "Donation date can't be in the future"
                },
                donation_expiry: {
                    required: "Please enter donation expiry date",
                    futureDate: "Date must be today or in the future"
                },
                family_id: "Please select family",
                donor_id: "Please select donor"
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

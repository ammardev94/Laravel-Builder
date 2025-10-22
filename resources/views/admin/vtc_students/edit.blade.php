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
    
    .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff !important;
        border: 1px solid #007bff !important;
        color: #fff !important;
        font-weight: 500;
    }

    .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff !important;
        margin-right: 5px;
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.vtc_students.indexV3') }}">Students</a></li>
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

        <form action="{{ route('admin.vtc_students.update', $vtc_student->id) }}" method="POST" enctype="multipart/form-data" id="editStudentForm">
            @csrf

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Student</h3>
                </div>
                @method('PUT')
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label for="guardian_name">Guardian Name</label>
                            <input type="text" name="guardian_name" class="form-control" value="{{ old('guardian_name', $vtc_student->guardian_name) }}">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="guardian_occupation">Guardian Occupation</label>
                            <input type="text" name="guardian_occupation" class="form-control" value="{{ old('guardian_occupation', $vtc_student->guardian_occupation) }}">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="guardian_contact_no">Guardian Contact No</label>
                            <input type="text" name="guardian_contact_no" class="form-control" value="{{ old('guardian_contact_no', $vtc_student->guardian_contact_no) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="guardian_relation">Guardian Relation</label>
                            <input type="text" name="guardian_relation" class="form-control" value="{{ old('guardian_relation', $vtc_student->guardian_relation) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="gr_no">GR No</label>
                            <input type="text" name="gr_no" class="form-control" value="{{ old('gr_no', $vtc_student->gr_no) }}" required>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $vtc_student->name) }}" required minlength="3">
                        </div>


                        <div class="col-md-4 mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $vtc_student->email) }}">
                        </div>


                        <div class="col-md-4 mb-3">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" class="form-control" value="{{ old('dob', $vtc_student->dob) }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="gender">Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="">Select</option>
                                <option value="male" {{ old('gender', $vtc_student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $vtc_student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="marital_status">Marital Status</label>
                            <select name="marital_status" class="form-control" required>
                                <option value="">Select</option>
                                <option value="single" {{ old('marital_status', $vtc_student->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                                <option value="married" {{ old('marital_status', $vtc_student->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="occupation">Occupation</label>
                            <input type="text" name="occupation" class="form-control" value="{{ old('occupation', $vtc_student->occupation) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="contact_no">Contact No</label>
                            <input type="text" name="contact_no" class="form-control" value="{{ old('contact_no', $vtc_student->contact_no) }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="whatsapp_no">WhatsApp No</label>
                            <input type="text" name="whatsapp_no" class="form-control" value="{{ old('whatsapp_no', $vtc_student->whatsapp_no) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $vtc_student->address) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="course_id">Select Course</label>
                                <select name="course_id[]" id="course_id"
                                    class="form-control select2 @error('course_id') is-invalid @enderror" multiple>
                                    <option value="">-- Select Course --</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ in_array($course->id, $selectedCourses ?? []) ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="days">Days</label>
                                @php $selectedDays = old('days', $vtc_student->days); @endphp
                                <select name="days" id="days" class="form-control select2 @error('days') is-invalid @enderror">
                                    <option value="">-- Select Days --</option>
                                    <option value="MWF" {{ $selectedDays === 'MWF' ? 'selected' : '' }}>MWF</option>
                                    <option value="TTS" {{ $selectedDays === 'TTS' ? 'selected' : '' }}>TTS</option>
                                    <option value="MTW" {{ $selectedDays === 'MTW' ? 'selected' : '' }}>MTW</option>
                                    <option value="TFS" {{ $selectedDays === 'TFS' ? 'selected' : '' }}>TFS</option>
                                    <option value="M-F" {{ $selectedDays === 'M-F' ? 'selected' : '' }}>M to F</option>
                                    <option value="M-S" {{ $selectedDays === 'M-S' ? 'selected' : '' }}>M to S</option>
                                </select>
                                @error('days')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="start_time">Start Time</label>
                            <input type="text" name="start_time" class="form-control" placeholder="01:00 PM"
                                value="{{ old('start_time', $vtc_student->start_time) }}">
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="end_time">End Time</label>
                            <input type="text" name="end_time" class="form-control" placeholder="01:00 PM"
                                value="{{ old('end_time', $vtc_student->end_time) }}">
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="zakat">Zakat</label>
                            <select name="zakat" id="zakat" class="form-control select2 @error('zakat') is-invalid @enderror">
                                <option value="1" {{ old('zakat', $vtc_student->zakat) == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('zakat', $vtc_student->zakat) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            @error('zakat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="mutual_partner_name">Mutual Partner Name</label>
                            <input type="text" name="mutual_partner_name" class="form-control" placeholder="Enter mutual partner name"
                                value="{{ old('mutual_partner_name', $vtc_student->mutual_partner_name) }}">
                            @error('mutual_partner_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="mutual_partner_gr">Mutual Partner G.R</label>
                            <input type="text" name="mutual_partner_gr" class="form-control" placeholder="Enter partner g.r"
                                value="{{ old('mutual_partner_gr', $vtc_student->mutual_partner_gr) }}">
                            @error('mutual_partner_gr')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="security_deposit_amount">Security Deposit Amount</label>
                            <input type="number" name="security_deposit_amount" class="form-control" placeholder="Ex. 5000"
                                value="{{ old('security_deposit_amount', $vtc_student->security_deposit_amount) }}">
                            @error('security_deposit_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="deduction_amount">Deduction Amount</label>
                            <input type="number" name="deduction_amount" class="form-control" placeholder="Ex. 5000"
                                value="{{ old('deduction_amount', $vtc_student->deduction_amount) }}">
                            @error('deduction_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="refund_amount">Refund Amount</label>
                            <input type="number" name="refund_amount" class="form-control" placeholder="Ex. 5000"
                                value="{{ old('refund_amount', $vtc_student->refund_amount) }}">
                            @error('refund_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-4 mb-3">
                            <label for="nationality">Nationality</label>
                            <input type="text" name="nationality" class="form-control" value="{{ old('nationality', $vtc_student->nationality) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="religion">Religion</label>
                            <input type="text" name="religion" class="form-control" value="{{ old('religion', $vtc_student->religion) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="img">Profile Image</label>
                                <input type="file" name="img" id="img" class="form-control" accept="image/*">
                                <div class="invalid-feedback">{{ $errors->first('img') }}</div>
                            </div>

                            <div class="mt-2">
                                <img id="img-preview" 
                                    src="{{ $vtc_student->img ? asset('storage/' . $vtc_student->img) : '#' }}" 
                                    alt="Image Preview" 
                                    class="img-fluid {{ $vtc_student->img ? '' : 'd-none' }} border p-1 rounded" 
                                    style="max-height: 150px;">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Student Academic Record</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="qualification">Degree / Certification</label>
                            <input id="qualification" type="text" name="qualification" class="form-control" placeholder="Enter degree or certification" value="{{ old('qualification', $vtc_student->academicRecords->qualification ?? '' ) }}" required>
                            <div class="invalid-feedback">{{ $errors->first('qualification') }}</div>
                        </div>
                        </div>
                        <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="institute_name">Institute</label>
                            <input id="institute_name" type="text" name="institute_name" class="form-control" placeholder="Enter institute name" value="{{ old('institute_name', $vtc_student->academicRecords->institute_name ?? '' ) }}" required>
                            <div class="invalid-feedback">{{ $errors->first('institute_name') }}</div>
                        </div>
                        </div>
                        <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="year">Passing Year</label>
                            <input id="year" type="number" name="year" class="form-control" placeholder="YYYY" value="{{ old('year', $vtc_student->academicRecords->year ?? '' ) }}" required min="1900" max="{{ date('Y') }}">
                            <div class="invalid-feedback">{{ $errors->first('year') }}</div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
                    <a href="{{ route('admin.vtc_students.indexV3') }}" class="btn btn-default"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
                </div>
            </div>
        </form>

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

    $('#course_id').select2({
        theme: 'bootstrap4',
        placeholder: "Select Courses",
        allowClear: true
    });


    $.validator.addMethod("pakPhone", function (value, element) {
        return this.optional(element) || /^03\d{9}$/.test(value);
    }, "Please enter a valid 11-digit phone number starting with 03");

    $.validator.addMethod("time12h", function (value, element) {
        return this.optional(element) || /^(0[1-9]|1[0-2]):[0-5][0-9] (AM|PM)$/i.test(value);
    }, "Please enter time in hh:mm AM/PM format (e.g., 01:00 PM)");

    $('#editStudentForm').validate({
        rules: {
            gr_no: { required: true },
            name: { required: true, minlength: 3 },
            dob: { required: true, date: true },
            gender: { required: true },
            marital_status: { required: true },
            guardian_contact_no: { required: true, pakPhone: true },
            contact_no: { required: true, pakPhone: true },
            whatsapp_no: { required: true, pakPhone: true },
            address: { required: true },
            'course_id[]': { required: true, maxlength: 1 },
            qualification: { required: true, minlength: 2 },
            institute_name: { required: true, minlength: 2 },
            year: { required: true, digits: true, minlength: 4, maxlength: 4 },
            days: { required: true },
            start_time: { required: true, time12h: true },
            end_time: { required: true, time12h: true },
            zakat: { required: true },
            security_deposit_amount: { required: true, number: true, min: 0 },
            deduction_amount: { required: true, number: true, min: 0 },
            refund_amount: { required: true, number: true, min: 0 }
        },
        messages: {
            gr_no: "Please enter GR number",
            name: "Please enter full name",
            dob: "Please enter date of birth",
            gender: "Please select gender",
            marital_status: "Please select marital status",
            contact_no: {
                required: "Please enter contact number",
                pakPhone: "Please enter a valid phone number in format 03xxxxxxxxx"
            },
            whatsapp_no: {
                required: "Please enter whatsapp number",
                pakPhone: "Please enter a valid phone number in format 03xxxxxxxxx"
            },
            address: "Please enter address",
            'course_id[]': "Please select only single course",
            qualification: "Please enter degree/certification",
            institute_name: "Please enter institute name",
            year: "Please enter a valid year",
            days: "Please select days",
            start_time: {
                required: "Please enter start time",
                time12h: "Time must be in format hh:mm AM/PM"
            },
            end_time: {
                required: "Please enter end time",
                time12h: "Time must be in format hh:mm AM/PM"
            },
            zakat: "Please select zakat status",
            security_deposit_amount: "Please enter a valid security deposit amount",
            deduction_amount: "Please enter a valid deduction amount",
            refund_amount: "Please enter a valid refund amount"
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

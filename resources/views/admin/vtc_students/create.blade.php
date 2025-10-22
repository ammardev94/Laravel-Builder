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
        <h1 class="m-0">Add Student</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.vtc_students.indexV3') }}">Students</a></li>
          <li class="breadcrumb-item active">Add Student</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Content -->
<div class="content">
  <div class="container-fluid">
    @include('include.messages')
    <form action="{{ route('admin.vtc_students.store') }}" method="POST" id="addStudentForm" enctype="multipart/form-data">
      @csrf
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Student Information</h3>
        </div>
        <div class="card-body">
          <div class="row">

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="guardian_name">Guardian Name</label>
                <input type="text" name="guardian_name" class="form-control" placeholder="Enter guardian's name" value="{{ old('guardian_name') }}">
                <div class="invalid-feedback">{{ $errors->first('guardian_name') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="guardian_occupation">Guardian Occupation</label>
                <input type="text" name="guardian_occupation" class="form-control" placeholder="Enter guardian's occupation" value="{{ old('guardian_occupation') }}">
                <div class="invalid-feedback">{{ $errors->first('guardian_occupation') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="guardian_contact_no">Guardian Contact Number</label>
                <input type="text" id="guardian_contact_no" name="guardian_contact_no" class="form-control" placeholder="03xxxxxxxxx" value="{{ old('guardian_contact_no') }}">
                <div class="invalid-feedback">{{ $errors->first('guardian_contact_no') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="guardian_relation">Guardian Relation</label>
                <input type="text" id="guardian_relation" name="guardian_relation" class="form-control" placeholder="Enter guardian relation" value="{{ old('guardian_relation') }}">
                <div class="invalid-feedback">{{ $errors->first('guardian_relation') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="gr_no">GR No</label>
                <input type="text" name="gr_no" class="form-control" placeholder="Enter GR Number" value="{{ old('gr_no') }}" required>
                <div class="invalid-feedback">{{ $errors->first('gr_no') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter full name" value="{{ old('name') }}" required minlength="3">
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" name="dob" class="form-control" value="{{ old('dob') }}" required>
                <div class="invalid-feedback">{{ $errors->first('dob') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" class="form-control" required>
                  <option value="">Select</option>
                  <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                  <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                <div class="invalid-feedback">{{ $errors->first('gender') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="marital_status">Marital Status</label>
                <select name="marital_status" class="form-control" required>
                  <option value="">Select</option>
                  <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                  <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                </select>
                <div class="invalid-feedback">{{ $errors->first('marital_status') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="occupation">Occupation</label>
                <input type="text" name="occupation" class="form-control" placeholder="Enter occupation" value="{{ old('occupation') }}">
                <div class="invalid-feedback">{{ $errors->first('occupation') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="contact_no">Contact No</label>
                <input type="text" name="contact_no" class="form-control" placeholder="03xxxxxxxxx" value="{{ old('contact_no') }}" required>
                <div class="invalid-feedback">{{ $errors->first('contact_no') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="whatsapp_no">WhatsApp No</label>
                <input type="text" name="whatsapp_no" class="form-control" placeholder="03xxxxxxxxx" value="{{ old('whatsapp_no') }}">
                <div class="invalid-feedback">{{ $errors->first('whatsapp_no') }}</div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" class="form-control" placeholder="Enter address" value="{{ old('address') }}" required></textarea>
                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="course_id">Select Course</label>
                <select name="course_id[]" id="course_id" class="form-control select2 @error('course_id') is-invalid @enderror" multiple>
                    <option value="">-- Select Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
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
                <select name="days" id="days" class="form-control select2 @error('days') is-invalid @enderror">
                    <option value="">-- Select Days --</option>
                    <option value="MWF">MWF</option>
                    <option value="TTS">TTS</option>
                    <option value="MTW">MTW</option>
                    <option value="TFS">TFS</option>
                    <option value="M-F">M to F</option>
                    <option value="M-S">M to S</option>
                </select>
                @error('days')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="text" name="start_time" class="form-control" placeholder="01:00 PM" value="{{ old('start_time') }}">
                <div class="invalid-feedback">{{ $errors->first('start_time') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="text" name="end_time" class="form-control" placeholder="01:00 PM" value="{{ old('end_time') }}">
                <div class="invalid-feedback">{{ $errors->first('end_time') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="zakat">Zakat</label>
                <select name="zakat" id="zakat" class="form-control select2 @error('zakat') is-invalid @enderror">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @error('zakat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="mutual_partner_name">Mutual Partner Name</label>
                <input type="text" name="mutual_partner_name" class="form-control" placeholder="Enter mutual partner name" value="{{ old('mutual_partner_name') }}">
                <div class="invalid-feedback">{{ $errors->first('mutual_partner_name') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="mutual_partner_gr">Mutual Partner G.R</label>
                <input type="text" name="mutual_partner_gr" class="form-control" placeholder="Enter partner g.r" value="{{ old('mutual_partner_gr') }}">
                <div class="invalid-feedback">{{ $errors->first('mutual_partner_gr') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="security_deposit_amount">Security Deposit Amount</label>
                <input type="number" name="security_deposit_amount" class="form-control" placeholder="Ex. 5000" value="{{ old('security_deposit_amount') }}">
                <div class="invalid-feedback">{{ $errors->first('security_deposit_amount') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="deduction_amount">Deduction Amount</label>
                <input type="number" name="deduction_amount" class="form-control" placeholder="Ex. 5000" value="{{ old('deduction_amount') }}">
                <div class="invalid-feedback">{{ $errors->first('deduction_amount') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="refund_amount">Refund Amount</label>
                <input type="number" name="refund_amount" class="form-control" placeholder="Ex. 5000" value="{{ old('refund_amount') }}">
                <div class="invalid-feedback">{{ $errors->first('refund_amount') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" name="nationality" class="form-control" placeholder="Enter nationality" value="{{ old('nationality') }}">
                <div class="invalid-feedback">{{ $errors->first('nationality') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="religion">Religion</label>
                <input type="text" name="religion" class="form-control" placeholder="Enter religion" value="{{ old('religion') }}">
                <div class="invalid-feedback">{{ $errors->first('religion') }}</div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="form-group">
                    <label for="img">Profile Image</label>
                    <input type="file" name="img" id="img" class="form-control" accept="image/*">
                    <div class="invalid-feedback">{{ $errors->first('img') }}</div>
                </div>
                <div class="mt-2">
                    <img id="img-preview" src="#" alt="Image Preview" class="img-fluid d-none border p-1 rounded" style="max-height: 150px;">
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
                <input id="qualification" type="text" name="qualification" class="form-control" placeholder="Enter degree or certification" value="{{ old('qualification') }}" required>
                <div class="invalid-feedback">{{ $errors->first('qualification') }}</div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="institute_name">Institute</label>
                <input id="institute_name" type="text" name="institute_name" class="form-control" placeholder="Enter institute name" value="{{ old('institute_name') }}" required>
                <div class="invalid-feedback">{{ $errors->first('institute_name') }}</div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="year">Passing Year</label>
                <input id="year" type="number" name="year" class="form-control" placeholder="YYYY" value="{{ old('year') }}" required min="1900" max="{{ date('Y') }}">
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

        $('#addStudentForm').validate({
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

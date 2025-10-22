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
        <h1 class="m-0">Add Family</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.families.index') }}">Families</a></li>
          <li class="breadcrumb-item active">Add Family</li>
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
        <h3 class="card-title">Add Family</h3>
      </div>

      <form action="{{ route('admin.families.store') }}" method="POST" id="addFamilyForm">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="father_name">Father Name</label>
                <input type="text" name="father_name" class="form-control" placeholder="Enter father's name" value="{{ old('father_name') }}" required minlength="3">
                <div class="invalid-feedback">{{ $errors->first('father_name') }}</div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="father_cnic">Father CNIC</label>
                <input type="text" name="father_cnic" class="form-control" placeholder="Enter father's CNIC" value="{{ old('father_cnic') }}" required pattern="\d{5}-\d{7}-\d">
                <div class="invalid-feedback">{{ $errors->first('father_cnic') }}</div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="father_phone">Father Phone</label>
                <input type="text" name="father_phone" class="form-control" placeholder="Enter father's phone number" value="{{ old('father_phone') }}" required>
                <div class="invalid-feedback">{{ $errors->first('father_phone') }}</div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="father_occup">Father Occupation</label>
                <input type="text" name="father_occup" class="form-control" placeholder="Enter father's occupation" value="{{ old('father_occup') }}" required>
                <div class="invalid-feedback">{{ $errors->first('father_occup') }}</div>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter home address" value="{{ old('address') }}" required>
                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="mother_name">Mother Name</label>
                <input type="text" name="mother_name" class="form-control" placeholder="Enter mother's name" value="{{ old('mother_name') }}" required>
                <div class="invalid-feedback">{{ $errors->first('mother_name') }}</div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="mother_cnic">Mother CNIC</label>
                <input type="text" name="mother_cnic" class="form-control" placeholder="Enter mother's CNIC" value="{{ old('mother_cnic') }}">
                <div class="invalid-feedback">{{ $errors->first('mother_cnic') }}</div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="mother_occup">Mother Occupation</label>
                <input type="text" name="mother_occup" class="form-control" placeholder="Enter mother's occupation" value="{{ old('mother_occup') }}">
                <div class="invalid-feedback">{{ $errors->first('mother_occup') }}</div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="children_count">Children Count</label>
                <input type="number" name="children_count" class="form-control" placeholder="Enter number of children" value="{{ old('children_count') }}" required min="0">
                <div class="invalid-feedback">{{ $errors->first('children_count') }}</div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="zakat">Zakat</label>
                <select id="zakat" name="zakat" class="form-control">
                  <option value="">Select</option>
                  <option value="yes" {{ old('zakat') == 'yes' ? 'selected' : '' }}>Yes</option>
                  <option value="no" {{ old('zakat') == 'no' ? 'selected' : '' }}>No</option>
                </select>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="religion">Religion</label>
                <input type="text" id="religion" name="religion" class="form-control" placeholder="Enter religion" value="{{ old('religion') }}">
                <div class="invalid-feedback">{{ $errors->first('religion') }}</div>
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <div class="form-group">
                <label for="emerg_name">Emergency Contact Name</label>
                <input type="text" name="emerg_name" class="form-control" placeholder="Enter emergency contact name" value="{{ old('emerg_name') }}" required>
                <div class="invalid-feedback">{{ $errors->first('emerg_name') }}</div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="emerg_relation">Emergency Relation</label>
                <input type="text" name="emerg_relation" class="form-control" placeholder="Enter relation with emergency contact" value="{{ old('emerg_relation') }}" required>
                <div class="invalid-feedback">{{ $errors->first('emerg_relation') }}</div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="emerg_num">Emergency Number</label>
                <input type="text" id="emerg_num" name="emerg_num" class="form-control" placeholder="Enter emergency phone number" value="{{ old('emerg_num') }}" required>
                <div class="invalid-feedback">{{ $errors->first('emerg_num') }}</div>
              </div>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
          <a href="{{ route('admin.families.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {

        $.validator.addMethod("cnic", function (value, element) {
        return this.optional(element) || /^\d{5}-\d{7}-\d{1}$/.test(value);
        }, "Please enter a valid CNIC in format 12345-1234567-1");

        $.validator.addMethod("pakPhone", function (value, element) {
            return this.optional(element) || /^03\d{9}$/.test(value);
        }, "Please enter a valid 11-digit phone number starting with 03");

        $('#addFamilyForm').validate({
        rules: {
            father_name: { required: true, minlength: 3 },
            father_cnic: { required: true, cnic: true },
            father_phone: { required: true, pakPhone: true },
            father_occup: { required: true },
            address: { required: true },
            zakat: { required: true },
            religion: { required: true, maxlength: 12  },
            children_count: { required: true, number: true, min: 0 },
            mother_name: { required: true },
            mother_cnic: { required: true, cnic: true },
            mother_occup: { required: true },
            emerg_name: { required: true },
            emerg_relation: { required: true },
            emerg_num: { required: true, pakPhone: true }
        },
        messages: {
            father_name: "Please enter father's name",
            father_cnic: {
                required: "Please enter father's CNIC",
                cnic: "Please enter a valid CNIC in format 12345-1234567-1"
            },
            father_phone: {
                required: "Please enter father's phone number",
                pakPhone: "Please enter a valid phone number in format 03xxxxxxxxx"
            },
            father_occup: "Please enter father's occupation",
            address: "Please enter address",
            children_count: {
                required: "Please enter number of children",
                number: "Only numbers allowed",
                min: "Cannot be negative"
            },
            mother_name: "Please enter mother's name",
            mother_cnic: {
                required: "Please enter mother's CNIC",
                cnic: "Please enter a valid CNIC in format 12345-1234567-1"
            },
            emerg_name: "Please enter emergency contact name",
            emerg_relation: "Please enter relation",
            emerg_num: {
                required: "Please enter emergency phone number",
                pakPhone: "Please enter a valid phone number in format 03xxxxxxxxx"
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

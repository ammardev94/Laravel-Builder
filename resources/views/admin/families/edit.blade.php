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
        <h1 class="m-0">Edit Family</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.families.index') }}">Families</a></li>
          <li class="breadcrumb-item active">Edit Family</li>
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
        <h3 class="card-title">Edit Family</h3>
      </div>

      <form action="{{ route('admin.families.update', $family->id) }}" method="POST" id="editFamilyForm">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="father_name">Father Name</label>
              <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $family->father_name) }}" placeholder="Enter father's name" required minlength="3">
            </div>
            <div class="col-md-6 mb-3">
              <label for="father_cnic">Father CNIC</label>
              <input type="text" name="father_cnic" class="form-control" value="{{ old('father_cnic', $family->father_cnic) }}" placeholder="Enter father's CNIC" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="father_phone">Father Phone</label>
              <input type="text" name="father_phone" class="form-control" value="{{ old('father_phone', $family->father_phone) }}" placeholder="Enter father's phone number" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="father_occup">Father Occupation</label>
              <input type="text" name="father_occup" class="form-control" value="{{ old('father_occup', $family->father_occup) }}" placeholder="Enter father's occupation" required>
            </div>
            <div class="col-md-12 mb-3">
              <label for="address">Address</label>
              <input type="text" name="address" class="form-control" value="{{ old('address', $family->address) }}" placeholder="Enter home address" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="mother_name">Mother Name</label>
              <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name', $family->mother_name) }}" placeholder="Enter mother's name" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="mother_cnic">Mother CNIC</label>
              <input type="text" name="mother_cnic" class="form-control" value="{{ old('mother_cnic', $family->mother_cnic) }}" placeholder="Enter mother's CNIC" required>
            </div>
            <div class="col-md-4 mb-3">
              <label for="mother_occup">Mother Occupation</label>
              <input type="text" name="mother_occup" class="form-control" value="{{ old('mother_occup', $family->mother_occup) }}" placeholder="Enter mother's occupation" required>
            </div>
            <div class="col-md-3 mb-3">
              <label for="children_count">Children Count</label>
              <input type="number" name="children_count" class="form-control" value="{{ old('children_count', $family->children_count) }}" placeholder="Enter number of children" required min="0">
            </div>
            <div class="col-md-3 mb-3">
              <label for="zakat">Zakat</label>
              <select name="zakat" class="form-control" required>
                <option value="">Select</option>
                <option value="yes" {{ old('zakat', $family->zakat) == 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ old('zakat', $family->zakat) == 'no' ? 'selected' : '' }}>No</option>
              </select>
            </div>
            <div class="col-md-3 mb-3">
              <label for="religion">Religion</label>
              <input type="text" name="religion" class="form-control" value="{{ old('religion', $family->religion) }}" placeholder="Enter religion" required>
            </div>
            <div class="col-md-3 mb-3">
              <label for="emerg_name">Emergency Contact Name</label>
              <input type="text" name="emerg_name" class="form-control" value="{{ old('emerg_name', $family->emerg_name) }}" placeholder="Enter emergency contact name" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="emerg_relation">Emergency Relation</label>
              <input type="text" name="emerg_relation" class="form-control" value="{{ old('emerg_relation', $family->emerg_relation) }}" placeholder="Enter relation with emergency contact" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="emerg_num">Emergency Number</label>
              <input type="text" name="emerg_num" class="form-control" value="{{ old('emerg_num', $family->emerg_num) }}" placeholder="Enter emergency phone number" required>
            </div>
          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Update</button>
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
    $.validator.addMethod("cnic", function (value) {
      return /^\d{5}-\d{7}-\d{1}$/.test(value);
    }, "Please enter a valid CNIC in format 12345-1234567-1");

    $.validator.addMethod("pakPhone", function (value) {
      return /^03\d{9}$/.test(value);
    }, "Please enter a valid 11-digit phone number starting with 03");

    $('#editFamilyForm').validate({
      rules: {
        father_name: { required: true, minlength: 3 },
        father_cnic: { required: true, cnic: true },
        father_phone: { required: true, pakPhone: true },
        father_occup: { required: true },
        address: { required: true },
        zakat: { required: true },
        religion: { required: true, maxlength: 12 },
        children_count: { required: true, number: true, min: 0 },
        mother_name: { required: true },
        mother_cnic: { required: true, cnic: true },
        mother_occup: { required: true },
        emerg_name: { required: true },
        emerg_relation: { required: true },
        emerg_num: { required: true, pakPhone: true }
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

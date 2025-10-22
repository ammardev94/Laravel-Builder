@extends('admin.default')

@section('content')
<!-- Page Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Spear</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.spear.index') }}">Spear</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Form -->
<div class="content">
  <div class="container-fluid">
    @include('include.messages')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Spear</h3>
        </div>

        <form action="{{ route('admin.spear.update', $spear->id) }}" method="POST" id="editSpearForm">
          @csrf
          @method('PUT')
    
          <div class="card-body">
            <div class="row">
              @php
                $fields = [
                  ['semis_code', 'SEMIS Code', 'text'],
                  ['school_name', 'School Name', 'text'],
                  ['hm_name', 'Headmaster Name', 'text'],
                  ['hm_contact_num', 'Headmaster Contact Number', 'text'],
                  ['hm_whatsapp_num', 'WhatsApp Number', 'text'],
                  ['emerg_num', 'Emergency Number', 'text'],
                  ['teacher_count', 'Teacher Count', 'number'],
                  ['non_teacher_count', 'Non-Teacher Count', 'number'],
                  ['medium', 'Medium', 'text'],
                  ['stu_count', 'Student Count', 'number'],
                  ['class1', 'Class 1', 'number'],
                  ['class2', 'Class 2', 'number'],
                  ['class3', 'Class 3', 'number'],
                  ['class4', 'Class 4', 'number'],
                  ['class5', 'Class 5', 'number'],
                ];
              @endphp
    
              @foreach($fields as [$name, $label, $type])
              <div class="col-md-6 mb-3">
                <label for="{{ $name }}">{{ $label }}</label>
                <input type="{{ $type }}" name="{{ $name }}" class="form-control"
                  placeholder="Enter {{ strtolower($label) }}"
                  value="{{ old($name, $spear->$name) }}" required>
                @error($name)
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              @endforeach
            </div>
          </div>
    
          <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
            <a href="{{ route('admin.spear.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i> Cancel</a>
          </div>
        </form>
    </div>

  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function () {
    $.validator.addMethod("pkPhone", function (value, element) {
      return this.optional(element) || /^(\+92|92|0)3[0-9]{9}$/.test(value);
    }, "Enter a valid Pakistani phone number (e.g. 03XXXXXXXXX)");

    $("#editSpearForm").validate({
      rules: {
        semis_code: { required: true, maxlength: 45 },
        school_name: { required: true, maxlength: 45 },
        hm_name: { required: true, maxlength: 45 },
        hm_contact_num: { required: true, pkPhone: true },
        hm_whatsapp_num: { required: true, pkPhone: true },
        emerg_num: { required: true, pkPhone: true },
        teacher_count: { required: true, digits: true },
        non_teacher_count: { required: true, digits: true },
        medium: { required: true, maxlength: 45 },
        stu_count: { required: true, digits: true },
        class1: { required: true, digits: true },
        class2: { required: true, digits: true },
        class3: { required: true, digits: true },
        class4: { required: true, digits: true },
        class5: { required: true, digits: true },
      }
    });
  });
</script>
@endsection

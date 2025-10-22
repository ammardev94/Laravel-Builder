@extends('admin.default')

@section('content')

<!-- Page Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add Spear</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.spear.index') }}">Spear</a></li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Form Content -->
<div class="content">
  <div class="container-fluid">
    @include('include.messages')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Spear</h3>
        </div>

        <form action="{{ route('admin.spear.store') }}" method="POST" id="addSpearForm">
          @csrf
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
                <input type="{{ $type }}" name="{{ $name }}" class="form-control" placeholder="Enter {{ strtolower($label) }}" value="{{ old($name) }}" required>
                @error($name)
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
              @endforeach
            </div>
          </div>
    
          <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
            <a href="{{ route('admin.spear.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i> Cancel</a>
          </div>
        </form>
    </div>

  </div>
</div>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
        $.validator.addMethod("pkPhone", function (value, element) {
            return this.optional(element) || /^(\+92|0)3\d{9}$/.test(value);
        }, "Enter a valid Pakistani phone number (e.g. 03XXXXXXXXX or +923XXXXXXXXX)");

        $("#addSpearForm").validate({
            rules: {
            semis_code: { required: true, maxlength: 45 },
            school_name: { required: true, maxlength: 45 },
            hm_name: { required: true, maxlength: 45 },
            hm_contact_num: { required: true, maxlength: 45, pkPhone: true },
            hm_whatsapp_num: { required: true, maxlength: 45, pkPhone: true },
            emerg_num: { required: true, maxlength: 45, pkPhone: true },
            teacher_count: { required: true, maxlength: 45 },
            non_teacher_count: { required: true, maxlength: 45 },
            medium: { required: true, maxlength: 45 },
            stu_count: { required: true, maxlength: 45 },
            class1: { required: true, maxlength: 45 },
            class2: { required: true, maxlength: 45 },
            class3: { required: true, maxlength: 45 },
            class4: { required: true, maxlength: 45 },
            class5: { required: true, maxlength: 45 },
            },
            messages: {
            hm_contact_num: { pkPhone: "Enter a valid Pakistani phone number" },
            hm_whatsapp_num: { pkPhone: "Enter a valid Pakistani phone number" },
            emerg_num: { pkPhone: "Enter a valid Pakistani phone number" },
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


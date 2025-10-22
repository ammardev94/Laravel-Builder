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
        <h1 class="m-0">Edit Family Service</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.family_services.index') }}">Family Services</a></li>
          <li class="breadcrumb-item active">Edit Family Service</li>
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
        <h3 class="card-title">Edit Family Service</h3>
      </div>

      <form action="{{ route('admin.family_services.update', $familyService->id) }}" method="POST" id="editFamilyServiceForm">
        @csrf
        @method('PUT')
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="family_id">Select Family</label>
                <select name="family_id" id="family_id" class="form-control">
                  <option value="">Select Family</option>
                  @foreach($families as $family)
                      <option value="{{ $family->id }}" {{ $family->id == $familyService->family_id ? 'selected' : '' }}>
                          {{ $family->father_name }} - {{ $family->father_cnic }}
                      </option>
                  @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('family_id') }}</div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="service">Service</label>
                <input type="text" name="service" id="service" class="form-control" value="{{ old('service', $familyService->service) }}" placeholder="Enter service" required minlength="3">
                <div class="invalid-feedback">{{ $errors->first('service') }}</div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $familyService->date) }}" required>
                <div class="invalid-feedback">{{ $errors->first('date') }}</div>
              </div>
            </div>

          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>&nbsp;&nbsp;Update
          </button>
          <a href="{{ route('admin.family_services.index') }}" class="btn btn-default">
            <i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#family_id').select2({
            placeholder: 'Select Family'
        });

        $.validator.addMethod("noFutureDate", function(value, element) {
            const inputDate = new Date(value);
            const today = new Date();

            inputDate.setHours(0, 0, 0, 0);
            today.setHours(0, 0, 0, 0);

            return this.optional(element) || inputDate <= today;
        }, "Future dates are not allowed");


        $('#editFamilyServiceForm').validate({
            rules: {
              family_id: {
                  required: true
              },
              service: {
                  required: true,
                  minlength: 3
              },
              date: {
                  required: true,
                  date: true,
                  noFutureDate: true
              }
            },
            messages: {
                family_id: "Please select a family",
                service: {
                    required: "Please enter a service",
                    minlength: "Service must be at least 3 characters long"
                },
                date: "Please select a valid date"
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

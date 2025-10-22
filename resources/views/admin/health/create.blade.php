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
                <h1 class="m-0">Add Health Record</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.health.index') }}">Health Records</a></li>
                    <li class="breadcrumb-item active">Add Health Record</li>
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
                <h3 class="card-title">Add Health Record</h3>
            </div>

            <form action="{{ route('admin.health.store') }}" method="POST" id="addHealthForm">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <!-- Student Select -->
                        <div class="col-md-6 mb-3">
                            <label for="student_id">Student</label>
                            <select id="student_id" name="student_id" class="form-control" required>
                                <option value="">Select Student</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->stu_full_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Family Select -->
                        <div class="col-md-6 mb-3">
                            <label for="family_id">Family</label>
                            <select id="family_id" name="family_id" class="form-control" required>
                                <option value="">Select Family</option>
                                @foreach($families as $family)
                                    <option value="{{ $family->id }}" {{ old('family_id') == $family->id ? 'selected' : '' }}>
                                        {{ $family->father_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('family_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        @php
                            $fields = [
                                ['checkup_date', 'datetime-local', 'Select checkup date'],
                                ['pulse', 'number', 'Enter pulse rate'],
                                ['body_temp', 'number', 'Enter body temperature', 'step=0.1'],
                                ['respiration', 'number', 'Enter respiration rate', 'step=0.1'],
                                ['bp', 'text', 'Enter blood pressure (e.g. 120/80)'],
                                ['height_cm', 'number', 'Enter height in cm'],
                                ['weight', 'number', 'Enter weight in kg', 'step=0.1'],
                                ['bmi', 'number', 'Enter BMI', 'step=0.1'],
                                ['bmi_percentile', 'number', 'Enter BMI percentile'],
                                ['eye_left', 'number', 'Enter left eye vision (optional)', 'step=0.1'],
                                ['eye_right', 'number', 'Enter right eye vision (optional)', 'step=0.1'],
                                ['pallor', 'text', 'Enter pallor status'],
                                ['lice', 'text', 'Enter lice condition'],
                                ['consciousness', 'text', 'Enter consciousness status'],
                                ['diet', 'text', 'Enter diet status'],
                                ['teeth', 'text', 'Enter teeth condition'],
                                ['history', 'text', 'Enter medical history'],
                                ['diagnosis', 'text', 'Enter diagnosis'],
                                ['management', 'text', 'Enter management plan'],
                                ['advice', 'text', 'Enter advice'],
                                ['refer', 'text', 'Enter referral info'],
                                ['followup', 'text', 'Enter follow-up instructions'],
                                ['session', 'text', 'Enter session info'],
                            ];
                        @endphp

                        @foreach ($fields as $field)
                            @php
                                [$name, $type, $placeholder, $attr] = array_pad($field, 4, '');
                            @endphp
                            <div class="col-md-6 mb-3">
                                <label for="{{ $name }}">{{ ucwords(str_replace('_', ' ', $name)) }}</label>
                                <input type="{{ $type }}" name="{{ $name }}" class="form-control"
                                    placeholder="{{ $placeholder }}" value="{{ old($name) }}" {{ $attr }} required>
                                @error($name)
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                    <a href="{{ route('admin.health.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i> Cancel</a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function () {

    $('#student_id').select2({
        placeholder: 'Select Student'
    });

    $('#family_id').select2({
        placeholder: 'Select Family'
    });

    $('#addHealthForm').validate({
        rules: {
            student_id: { required: true },
            family_id: { required: true },
            checkup_date: { required: true, date: true },
            pulse: { required: true, digits: true },
            body_temp: { required: true, number: true },
            respiration: { required: true, number: true },
            bp: { required: true, maxlength: 45 },
            height_cm: { required: true, digits: true },
            weight: { required: true, number: true },
            bmi: { required: true, number: true },
            bmi_percentile: { required: true, maxlength: 45 },
            eye_left: { number: true },
            eye_right: { number: true },
            pallor: { required: true, maxlength: 45 },
            lice: { required: true, maxlength: 45 },
            consciousness: { required: true, maxlength: 45 },
            diet: { required: true, maxlength: 45 },
            teeth: { required: true, maxlength: 45 },
            history: { required: true, maxlength: 100 },
            diagnosis: { required: true, maxlength: 100 },
            management: { required: true, maxlength: 100 },
            advice: { required: true, maxlength: 100 },
            refer: { required: true, maxlength: 100 },
            followup: { required: true, maxlength: 100 },
            session: { required: true, maxlength: 100 }
        },
        messages: {
            student_id: "Please select a student",
            family_id: "Please select a family",
            checkup_date: "Please enter a valid checkup date",
            pulse: "Please enter a valid pulse (digits only)",
            body_temp: "Please enter a valid body temperature",
            respiration: "Please enter a valid respiration value",
            bp: "Enter valid blood pressure (max 45 chars)",
            height_cm: "Please enter a valid height in cm (digits only)",
            weight: "Please enter a valid weight",
            bmi: "Please enter a valid BMI",
            bmi_percentile: "Max 45 characters allowed",
            pallor: "Required field (max 45 chars)",
            lice: "Required field (max 45 chars)",
            consciousness: "Required field (max 45 chars)",
            diet: "Required field (max 45 chars)",
            teeth: "Required field (max 45 chars)",
            history: "Required field (max 100 chars)",
            diagnosis: "Required field (max 100 chars)",
            management: "Required field (max 100 chars)",
            advice: "Required field (max 100 chars)",
            refer: "Required field (max 100 chars)",
            followup: "Required field (max 100 chars)",
            session: "Required field (max 100 chars)"
        },
        errorElement: "label",
        errorClass: "is-invalid text-danger",
        validClass: "is-valid",
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

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
                <h1 class="m-0">Edit Donor</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.donors.index') }}">Donors</a></li>
                    <li class="breadcrumb-item active">Edit Donor</li>
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
                <h3 class="card-title">Edit Donor</h3>
            </div>

            <form action="{{ route('admin.donors.update', $donor->id) }}" method="POST" id="editDonorForm">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="donor_name">Donor Name</label>
                            <input type="text" name="donor_name" class="form-control" placeholder="Enter donor name" value="{{ old('donor_name', $donor->donor_name) }}" required minlength="3">
                            <div class="invalid-feedback">{{ $errors->first('donor_name') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="donor_whatsapp">WhatsApp</label>
                            <input type="text" name="donor_whatsapp" class="form-control" placeholder="Enter donor whatsapp" value="{{ old('donor_whatsapp', $donor->donor_whatsapp) }}">
                            <div class="invalid-feedback">{{ $errors->first('donor_whatsapp') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="donor_ref_name">Reference Name</label>
                            <input type="text" name="donor_ref_name" class="form-control" placeholder="Enter donor reference name" value="{{ old('donor_ref_name', $donor->donor_ref_name) }}">
                            <div class="invalid-feedback">{{ $errors->first('donor_ref_name') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="donor_whatsapp_sec">WhatsApp Second</label>
                            <input type="text" name="donor_whatsapp_sec" class="form-control" placeholder="Enter donor whatsapp second number" value="{{ old('donor_whatsapp_sec', $donor->donor_whatsapp_sec) }}">
                            <div class="invalid-feedback">{{ $errors->first('donor_whatsapp_sec') }}</div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                    <a href="{{ route('admin.donors.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i> Cancel</a>
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
            return this.optional(element) || /^(03[0-9]{9}|\+923[0-9]{9})$/.test(value);
        }, "Enter a valid Pakistani phone number (03XXXXXXXXX or +923XXXXXXXXX)");

        $('#editDonorForm').validate({
            rules: {
                donor_name: {
                    required: true,
                    minlength: 3
                },
                donor_whatsapp: {
                    pkPhone: true
                },
                donor_whatsapp_sec: {
                    pkPhone: true
                }
            },
            messages: {
                donor_name: {
                    required: "Donor name is required",
                    minlength: "Minimum 3 characters required"
                },
                donor_whatsapp: {
                    pkPhone: "Please enter a valid WhatsApp number"
                },
                donor_whatsapp_sec: {
                    pkPhone: "Please enter a valid second WhatsApp number"
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

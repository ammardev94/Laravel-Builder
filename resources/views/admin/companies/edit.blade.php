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
                <h1 class="m-0">Edit Company</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.companies.index') }}">Companies</a></li>
                    <li class="breadcrumb-item active">Edit Company</li>
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
                <h3 class="card-title">Edit Company</h3>
            </div>

            <form action="{{ route('admin.companies.update', $company->idCompany) }}" method="POST" id="editCompanyForm">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row">
                        @php
                            $oldOr = fn($field) => old($field, $company->$field);
                        @endphp

                        <div class="col-md-6 mb-3">
                            <label for="companyName">Company Name</label>
                            <input type="text" name="companyName" class="form-control" value="{{ $oldOr('companyName') }}">
                            <div class="invalid-feedback">{{ $errors->first('companyName') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="companyAddress">Company Address</label>
                            <input type="text" name="companyAddress" class="form-control" value="{{ $oldOr('companyAddress') }}">
                            <div class="invalid-feedback">{{ $errors->first('companyAddress') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="companyPhone">Company Phone</label>
                            <input type="text" name="companyPhone" class="form-control" value="{{ $oldOr('companyPhone') }}">
                            <div class="invalid-feedback">{{ $errors->first('companyPhone') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="timeStamp">Timestamp</label>
                            <input type="datetime-local" name="timeStamp" class="form-control" value="{{ \Carbon\Carbon::parse($company->timeStamp)->format('Y-m-d\TH:i') }}">
                            <div class="invalid-feedback">{{ $errors->first('timeStamp') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="idUser">User ID</label>
                            <input type="number" name="idUser" class="form-control" value="{{ $oldOr('idUser') }}">
                            <div class="invalid-feedback">{{ $errors->first('idUser') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="isActive">Status</label>
                            <select name="isActive" class="form-control">
                                <option value="1" {{ $oldOr('isActive') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $oldOr('isActive') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('isActive') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="idBillTitle">Bill Title ID</label>
                            <input type="text" name="idBillTitle" class="form-control" value="{{ $oldOr('idBillTitle') }}">
                            <div class="invalid-feedback">{{ $errors->first('idBillTitle') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="unitPrice">Unit Price</label>
                            <input type="number" step="0.01" name="unitPrice" class="form-control" value="{{ $oldOr('unitPrice') }}">
                            <div class="invalid-feedback">{{ $errors->first('unitPrice') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="idCurrency">Currency ID</label>
                            <input type="text" name="idCurrency" class="form-control" value="{{ $oldOr('idCurrency') }}">
                            <div class="invalid-feedback">{{ $errors->first('idCurrency') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tSign">T Sign</label>
                            <input type="text" name="tSign" class="form-control" value="{{ $oldOr('tSign') }}">
                            <div class="invalid-feedback">{{ $errors->first('tSign') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="rSign">R Sign</label>
                            <input type="text" name="rSign" class="form-control" value="{{ $oldOr('rSign') }}">
                            <div class="invalid-feedback">{{ $errors->first('rSign') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="vat">VAT (%)</label>
                            <input type="number" step="0.01" name="vat" class="form-control" value="{{ $oldOr('vat') }}">
                            <div class="invalid-feedback">{{ $errors->first('vat') }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="smCharges">SM Charges</label>
                            <input type="number" step="0.01" name="smCharges" class="form-control" value="{{ $oldOr('smCharges') }}">
                            <div class="invalid-feedback">{{ $errors->first('smCharges') }}</div>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                    <a href="{{ route('admin.companies.index') }}" class="btn btn-default"><i class="fas fa-times-circle"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $.validator.addMethod("pkPhone", function (value, element) {
        return this.optional(element) || /^(03[0-9]{9}|(\+923)[0-9]{9})$/.test(value);
    }, "Enter a valid Pakistani phone number (e.g. 03XXXXXXXXX or +923XXXXXXXXX)");

    $(document).ready(function () {
        $('#editCompanyForm').validate({
            rules: {
                companyName: { required: true },
                companyAddress: { required: true },
                companyPhone: { required: true, pkPhone: true },
                timeStamp: { required: true },
                idUser: { required: true, digits: true },
                isActive: { required: true },
                idBillTitle: { required: true },
                unitPrice: { required: true, number: true },
                idCurrency: { required: true },
                tSign: { required: true },
                rSign: { required: true },
                vat: { required: true, number: true },
                smCharges: { required: true, number: true },
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

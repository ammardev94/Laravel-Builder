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
                <h1 class="m-0">Add LLCF Expense</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.expenses-llcf.index') }}">Expenses</a></li>
                    <li class="breadcrumb-item active">Add LLCF Expense</li>
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
                <h3 class="card-title">Add LLCF Expense</h3>
            </div>

            <form action="{{ route('admin.expenses-llcf.store') }}" method="POST" id="addExpenseForm">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <!-- Item Select -->
                        <div class="col-md-6 mb-3">
                            <label for="item_id">Item</label>
                            <select id="item_id" name="item_id" class="form-control" required>
                                <option value="">Select Item</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('item_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div class="col-md-6 mb-3">
                            <label for="date">Expense Date</label>
                            <input type="date" name="date" id="date" class="form-control" 
                                   value="{{ old('date') }}" required>
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Amount -->
                        <div class="col-md-6 mb-3">
                            <label for="amount">Amount</label>
                            <input type="number" step="0.01" name="amount" id="amount" class="form-control"
                                   placeholder="Enter expense amount" value="{{ old('amount') }}" required>
                            @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Type (Hidden: LLCF) -->
                        <input type="hidden" name="type" value="llcf">

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save
                    </button>
                    <a href="{{ route('admin.expenses-llcf.index') }}" class="btn btn-default">
                        <i class="fas fa-times-circle"></i> Cancel
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

    $('#item_id').select2({
        placeholder: 'Select Item'
    });

    $('#addExpenseForm').validate({
        rules: {
            item_id: { required: true },
            date: { required: true, date: true },
            amount: { required: true, number: true, min: 0 }
        },
        messages: {
            item_id: "Please select an item",
            date: "Please select a valid date",
            amount: {
                required: "Please enter an amount",
                number: "Amount must be a valid number",
                min: "Amount cannot be negative"
            }
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
